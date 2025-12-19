<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Models\Bid;
use App\Models\FarmerYield;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BidController extends Controller
{
    /**
     * Display a listing of the trader's bids.
     */
    public function index(): View
    {
        $trader = Auth::user();

        $query = Bid::where('trader_id', $trader->id)
            ->with(['yield.variety', 'yield.farmer']);

        // Filter by status if provided
        if (request()->has('status') && in_array(request('status'), ['pending', 'accepted', 'rejected'])) {
            $query->where('status', request('status'));
        }

        $bids = $query->latest()->paginate(15)->withQueryString();

        return view('trader.bids.index', compact('bids'));
    }

    /**
     * Store a newly created bid in storage.
     */
    public function store(BidRequest $request): RedirectResponse
    {
        $trader = Auth::user();
        $yield = FarmerYield::findOrFail($request->yield_id);

        // Check if yield is still active
        if ($yield->status !== 'active') {
            return back()->with('error', 'This yield is no longer available for bidding.');
        }

        // Check if trader has already placed a bid on this yield
        $existingBid = Bid::where('yield_id', $yield->id)
            ->where('trader_id', $trader->id)
            ->first();

        if ($existingBid) {
            return back()->with('error', 'You have already placed a bid on this yield.');
        }

        // Create the bid
        $bid = Bid::create([
            'yield_id' => $yield->id,
            'trader_id' => $trader->id,
            'bid_amount' => $request->bid_amount,
            'quantity' => $request->quantity ?? $yield->quantity,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        // Create notification for the farmer
        Notification::create([
            'user_id' => $yield->user_id,
            'title' => 'New Bid Received!',
            'message' => "{$trader->name} has placed a bid of ₹{$bid->bid_amount} on your {$yield->variety->name} listing.",
            'type' => 'bid_received',
            'is_read' => false,
            'action_url' => '/farmer/bids',
            'related_id' => $bid->id,
            'related_type' => 'bid',
        ]);

        return redirect()->route('trader.bids.show', $bid)
            ->with('success', 'Bid placed successfully! The farmer will be notified.');
    }

    /**
     * Display the specified bid.
     */
    public function show(Bid $bid): View
    {
        // Ensure the bid belongs to the authenticated trader
        if ($bid->trader_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this bid.');
        }

        $bid->load(['yield.variety', 'yield.farmer']);

        return view('trader.bids.show', compact('bid'));
    }

    /**
     * Update an existing bid (only if still pending).
     */
    public function update(BidRequest $request, Bid $bid): RedirectResponse
    {
        // Ensure the bid belongs to the authenticated trader
        if ($bid->trader_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this bid.');
        }

        // Check if bid is still pending
        if (! $bid->isPending()) {
            return back()->with('error', 'Cannot update a bid that has already been processed.');
        }

        // Check if yield is still active
        if ($bid->yield->status !== 'active') {
            return back()->with('error', 'This yield is no longer available.');
        }

        // Update the bid
        $bid->update([
            'bid_amount' => $request->bid_amount,
            'quantity' => $request->quantity ?? $bid->quantity,
            'message' => $request->message,
        ]);

        // Create notification for the farmer
        Notification::create([
            'user_id' => $bid->yield->user_id,
            'title' => 'Bid Updated',
            'message' => "{$bid->trader->name} has updated their bid to ₹{$bid->bid_amount} on your {$bid->yield->variety->name} listing.",
            'type' => 'bid_updated',
            'is_read' => false,
            'action_url' => '/farmer/bids',
            'related_id' => $bid->id,
            'related_type' => 'bid',
        ]);

        return redirect()->route('trader.bids.show', $bid)
            ->with('success', 'Bid updated successfully!');
    }

    /**
     * Cancel a bid (only if still pending).
     */
    public function cancel(Bid $bid): RedirectResponse
    {
        // Ensure the bid belongs to the authenticated trader
        if ($bid->trader_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this bid.');
        }

        // Check if bid is still pending
        if (! $bid->isPending()) {
            return back()->with('error', 'Cannot cancel a bid that has already been processed.');
        }

        // Soft delete the bid
        $bid->delete();

        return redirect()->route('trader.bids.index')
            ->with('success', 'Bid cancelled successfully.');
    }
}
