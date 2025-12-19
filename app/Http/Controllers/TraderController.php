<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\CropVariety;
use App\Models\FarmerYield;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TraderController extends Controller
{
    /**
     * Display the trader dashboard.
     *
     * Shows overview of recent yields, trader's bids, and statistics.
     */
    public function dashboard(): View
    {
        $trader = Auth::user();

        // Get trader's statistics
        $stats = [
            'total_bids' => Bid::where('trader_id', $trader->id)->count(),
            'pending_bids' => Bid::where('trader_id', $trader->id)->pending()->count(),
            'accepted_bids' => Bid::where('trader_id', $trader->id)->accepted()->count(),
            'rejected_bids' => Bid::where('trader_id', $trader->id)->rejected()->count(),
        ];

        // Get recent available yields (limit 6)
        $recentYields = FarmerYield::with(['variety', 'farmer', 'bids'])
            ->active()
            ->latest()
            ->take(6)
            ->get();

        // Get trader's recent bids (limit 5)
        $recentBids = Bid::where('trader_id', $trader->id)
            ->with(['yield.variety', 'yield.farmer'])
            ->latest()
            ->take(5)
            ->get();

        return view('trader.dashboard', compact('stats', 'recentYields', 'recentBids'));
    }

    /**
     * Browse available yields with search and filters.
     */
    public function browseYields(Request $request): View
    {
        $query = FarmerYield::with(['variety', 'farmer', 'bids'])
            ->active();

        // Search by variety name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('variety', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Filter by variety
        if ($request->filled('variety_id')) {
            $query->where('variety_id', $request->variety_id);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->byLocation($request->location);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price_per_ton', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price_per_ton', '<=', $request->max_price);
        }

        // Filter by quantity range
        if ($request->filled('min_quantity')) {
            $query->where('quantity', '>=', $request->min_quantity);
        }
        if ($request->filled('max_quantity')) {
            $query->where('quantity', '<=', $request->max_quantity);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price_per_ton', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price_per_ton', 'desc');
                break;
            case 'quantity_low':
                $query->orderBy('quantity', 'asc');
                break;
            case 'quantity_high':
                $query->orderBy('quantity', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $yields = $query->paginate(12)->withQueryString();

        // Get all varieties for filter dropdown
        $varieties = CropVariety::orderBy('name')->get();

        return view('trader.yields.browse', compact('yields', 'varieties'));
    }

    /**
     * Display a specific yield with details.
     */
    public function showYield(FarmerYield $yield): View
    {
        // Check if yield is active
        if ($yield->status !== 'active') {
            abort(404, 'This yield is no longer available.');
        }

        $yield->load(['variety', 'farmer', 'bids.trader']);

        // Check if current trader has already placed a bid
        $trader = Auth::user();
        $existingBid = Bid::where('yield_id', $yield->id)
            ->where('trader_id', $trader->id)
            ->first();

        return view('trader.yields.show', compact('yield', 'existingBid'));
    }

    /**
     * Display and edit trader profile.
     */
    public function profile(): View
    {
        $trader = Auth::user();

        return view('trader.profile', compact('trader'));
    }

    /**
     * Update trader profile.
     */
    public function updateProfile(Request $request)
    {
        $trader = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,'.$trader->id,
            'location' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle avatar upload if provided
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        $trader->update($validated);

        return redirect()->route('trader.profile')
            ->with('success', 'Profile updated successfully!');
    }
}
