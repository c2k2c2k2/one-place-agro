<?php

namespace App\Http\Controllers;

use App\Http\Requests\YieldRequest;
use App\Models\CropVariety;
use App\Models\FarmerYield;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class YieldController extends Controller
{
    /**
     * Display a listing of the farmer's yields.
     */
    public function index(): View
    {
        $farmer = Auth::user();

        // Get yields with optional status filter
        $query = FarmerYield::where('user_id', $farmer->id)
            ->with(['variety', 'bids']);

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $yields = $query->latest()->paginate(10);

        // Calculate statistics
        $stats = [
            'total' => FarmerYield::where('user_id', $farmer->id)->count(),
            'active' => FarmerYield::where('user_id', $farmer->id)->where('status', 'active')->count(),
            'sold' => FarmerYield::where('user_id', $farmer->id)->where('status', 'sold')->count(),
            'expired' => FarmerYield::where('user_id', $farmer->id)->where('status', 'expired')->count(),
        ];

        return view('farmer.yields.index', compact('yields', 'stats'));
    }

    /**
     * Show the form for creating a new yield.
     */
    public function create(): View
    {
        $varieties = CropVariety::orderBy('name')->get();

        return view('farmer.yields.create', compact('varieties'));
    }

    /**
     * Store a newly created yield in storage.
     */
    public function store(YieldRequest $request): RedirectResponse
    {
        $farmer = Auth::user();

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('yields', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create the yield
        $yield = FarmerYield::create([
            'user_id' => $farmer->id,
            'variety_id' => $request->variety_id,
            'quantity' => $request->quantity,
            'price_per_ton' => $request->price_per_ton,
            'description' => $request->description,
            'images' => $imagePaths,
            'status' => 'active',
            'harvest_date' => $request->harvest_date,
            'location' => $request->location ?? $farmer->location,
        ]);

        return redirect()->route('farmer.yields.show', $yield)
            ->with('success', 'Yield added successfully!');
    }

    /**
     * Display the specified yield.
     */
    public function show(FarmerYield $yield): View
    {
        // Ensure the yield belongs to the authenticated farmer
        if ($yield->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this yield.');
        }

        $yield->load(['variety', 'bids.trader']);

        return view('farmer.yields.show', compact('yield'));
    }

    /**
     * Show the form for editing the specified yield.
     */
    public function edit(FarmerYield $yield): View
    {
        // Ensure the yield belongs to the authenticated farmer
        if ($yield->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this yield.');
        }

        $varieties = CropVariety::orderBy('name')->get();

        return view('farmer.yields.edit', compact('yield', 'varieties'));
    }

    /**
     * Update the specified yield in storage.
     */
    public function update(YieldRequest $request, FarmerYield $yield): RedirectResponse
    {
        // Ensure the yield belongs to the authenticated farmer
        if ($yield->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this yield.');
        }

        // Handle image uploads
        $imagePaths = $yield->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('yields', 'public');
                $imagePaths[] = $path;
            }
        }

        // Handle image deletions
        if ($request->has('delete_images')) {
            $deleteImages = $request->delete_images;
            foreach ($deleteImages as $imagePath) {
                // Remove from storage
                Storage::disk('public')->delete($imagePath);
                // Remove from array
                $imagePaths = array_diff($imagePaths, [$imagePath]);
            }
            $imagePaths = array_values($imagePaths); // Re-index array
        }

        // Update the yield
        $yield->update([
            'variety_id' => $request->variety_id,
            'quantity' => $request->quantity,
            'price_per_ton' => $request->price_per_ton,
            'description' => $request->description,
            'images' => $imagePaths,
            'harvest_date' => $request->harvest_date,
            'location' => $request->location,
        ]);

        return redirect()->route('farmer.yields.show', $yield)
            ->with('success', 'Yield updated successfully!');
    }

    /**
     * Remove the specified yield from storage (soft delete).
     */
    public function destroy(FarmerYield $yield): RedirectResponse
    {
        // Ensure the yield belongs to the authenticated farmer
        if ($yield->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this yield.');
        }

        // Check if there are accepted bids
        $hasAcceptedBids = $yield->bids()->accepted()->exists();
        if ($hasAcceptedBids) {
            return redirect()->route('farmer.yields.index')
                ->with('error', 'Cannot delete yield with accepted bids.');
        }

        // Soft delete the yield
        $yield->delete();

        return redirect()->route('farmer.yields.index')
            ->with('success', 'Yield deleted successfully!');
    }
}
