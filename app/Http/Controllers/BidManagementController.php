<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BidManagementController extends Controller
{
    /**
     * Display a listing of bids on farmer's yields.
     */
    public function index(): View
    {
        $farmer = Auth::user();

        $query = Bid::whereHas('yield', function ($q) use ($farmer) {
            $q->where('user_id', $farmer->id);
        })->with(['yield.variety', 'trader']);

        // Filter by status if provided
        if (request()->has('status') && in_array(request('status'), ['pending', 'accepted', 'rejected'])) {
            $query->where('status', request('status'));
        }

        $bids = $query->latest()->paginate(15)->withQueryString();

        // Calculate statistics
        $stats = [
            'total' => Bid::whereHas('yield', function ($q) use ($farmer) {
                $q->where('user_id', $farmer->id);
            })->count(),
            'pending' => Bid::whereHas('yield', function ($q) use ($farmer) {
                $q->where('user_id', $farmer->id);
            })->where('status', 'pending')->count(),
            'accepted' => Bid::whereHas('yield', function ($q) use ($farmer) {
                $q->where('user_id', $farmer->id);
            })->where('status', 'accepted')->count(),
            'rejected' => Bid::whereHas('yield', function ($q) use ($farmer) {
                $q->where('user_id', $farmer->id);
            })->where('status', 'rejected')->count(),
        ];

        return view('farmer.bids.index', compact('bids', 'stats'));
    }

    /**
     * Accept a bid on a yield.
     */
    public function accept(Bid $bid): RedirectResponse
    {
        // Ensure the bid's yield belongs to the authenticated farmer
        if ($bid->yield->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if bid is still pending
        if (! $bid->isPending()) {
            return back()->with('error', 'This bid has already been processed.');
        }

        DB::transaction(function () use ($bid) {
            // Accept the bid
            $bid->update(['status' => 'accepted']);

            // Update yield status to sold
            $bid->yield->update(['status' => 'sold']);

            // Reject all other pending bids on this yield
            Bid::where('yield_id', $bid->yield_id)
                ->where('id', '!=', $bid->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

            // Create notification for the trader
            Notification::create([
                'user_id' => $bid->trader_id,
                'title' => 'Bid Accepted!',
                'message' => "Your bid of ₹{$bid->bid_amount} on {$bid->yield->variety->name} has been accepted!",
                'type' => 'bid_accepted',
                'is_read' => false,
                'action_url' => '/trader/bids',
                'related_id' => $bid->id,
                'related_type' => 'bid',
            ]);

            // Create notifications for rejected traders
            $rejectedBids = Bid::where('yield_id', $bid->yield_id)
                ->where('id', '!=', $bid->id)
                ->where('status', 'rejected')
                ->get();

            foreach ($rejectedBids as $rejectedBid) {
                Notification::create([
                    'user_id' => $rejectedBid->trader_id,
                    'title' => 'Bid Rejected',
                    'message' => "Your bid on {$bid->yield->variety->name} was not accepted. The yield has been sold to another trader.",
                    'type' => 'bid_rejected',
                    'is_read' => false,
                    'action_url' => '/trader/bids',
                    'related_id' => $rejectedBid->id,
                    'related_type' => 'bid',
                ]);
            }
        });

        return redirect()->route('farmer.bids.index')
            ->with('success', 'Bid accepted successfully! The yield has been marked as sold.');
    }

    /**
     * Reject a bid on a yield.
     */
    public function reject(Bid $bid): RedirectResponse
    {
        // Ensure the bid's yield belongs to the authenticated farmer
        if ($bid->yield->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if bid is still pending
        if (! $bid->isPending()) {
            return back()->with('error', 'This bid has already been processed.');
        }

        // Reject the bid
        $bid->update(['status' => 'rejected']);

        // Create notification for the trader
        Notification::create([
            'user_id' => $bid->trader_id,
            'title' => 'Bid Rejected',
            'message' => "Your bid of ₹{$bid->bid_amount} on {$bid->yield->variety->name} has been rejected.",
            'type' => 'bid_rejected',
            'is_read' => false,
            'action_url' => '/trader/bids',
            'related_id' => $bid->id,
            'related_type' => 'bid',
        ]);

        return redirect()->route('farmer.bids.index')
            ->with('success', 'Bid rejected successfully.');
    }
}
