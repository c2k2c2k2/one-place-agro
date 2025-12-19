<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\CropVariety;
use App\Models\FarmerYield;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FarmerController extends Controller
{
    /**
     * Display the farmer dashboard.
     *
     * Shows overview of active yields, recent bids, and statistics.
     */
    public function dashboard(): View
    {
        $farmer = Auth::user();

        // Get farmer's statistics
        $stats = [
            'total_yields' => FarmerYield::where('user_id', $farmer->id)->count(),
            'active_yields' => FarmerYield::where('user_id', $farmer->id)->active()->count(),
            'sold_yields' => FarmerYield::where('user_id', $farmer->id)->sold()->count(),
            'total_bids' => Bid::whereHas('yield', function ($query) use ($farmer) {
                $query->where('user_id', $farmer->id);
            })->count(),
            'pending_bids' => Bid::whereHas('yield', function ($query) use ($farmer) {
                $query->where('user_id', $farmer->id);
            })->pending()->count(),
        ];

        // Get recent active yields (limit 5)
        $recentYields = FarmerYield::where('user_id', $farmer->id)
            ->with(['variety', 'bids'])
            ->active()
            ->latest()
            ->take(5)
            ->get();

        // Get recent bids on farmer's yields (limit 5)
        $recentBids = Bid::whereHas('yield', function ($query) use ($farmer) {
            $query->where('user_id', $farmer->id);
        })
            ->with(['yield.variety', 'trader'])
            ->latest()
            ->take(5)
            ->get();

        return view('farmer.dashboard', compact('stats', 'recentYields', 'recentBids'));
    }

    /**
     * Display and edit farmer profile.
     */
    public function profile(): View
    {
        $farmer = Auth::user();

        return view('farmer.profile', compact('farmer'));
    }

    /**
     * Update farmer profile.
     */
    public function updateProfile(Request $request)
    {
        $farmer = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,'.$farmer->id,
            'location' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle avatar upload if provided
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        $farmer->update($validated);

        return redirect()->route('farmer.profile')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Browse trader requirements (what traders are looking for).
     */
    public function browseRequirements(Request $request): View
    {
        $query = Requirement::with(['variety', 'trader'])
            ->where('is_active', true);

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
            $query->where('location', 'like', '%'.$request->location.'%');
        }

        // Sort
        $sortBy = $request->get('sort_by', 'latest');
        switch ($sortBy) {
            case 'budget_high':
                $query->orderBy('max_budget', 'desc');
                break;
            case 'budget_low':
                $query->orderBy('max_budget', 'asc');
                break;
            case 'quantity_high':
                $query->orderBy('quantity_required', 'desc');
                break;
            case 'quantity_low':
                $query->orderBy('quantity_required', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $requirements = $query->paginate(12)->withQueryString();

        // Get all varieties for filter dropdown
        $varieties = CropVariety::orderBy('name')->get();

        return view('farmer.requirements.browse', compact('requirements', 'varieties'));
    }

    /**
     * Display a specific requirement.
     */
    public function showRequirement(Requirement $requirement): View
    {
        // Check if requirement is active
        if (! $requirement->is_active) {
            abort(404, 'This requirement is no longer active.');
        }

        $requirement->load(['variety', 'trader']);

        return view('farmer.requirements.show', compact('requirement'));
    }
}
