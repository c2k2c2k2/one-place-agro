<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequirementRequest;
use App\Models\CropVariety;
use App\Models\Requirement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RequirementController extends Controller
{
    /**
     * Display a listing of the trader's requirements.
     */
    public function index(): View
    {
        $trader = Auth::user();

        $query = Requirement::where('user_id', $trader->id)
            ->with('variety');

        // Filter by status if provided
        if (request()->has('status')) {
            $status = request('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($status === 'fulfilled') {
                $query->where('is_fulfilled', true);
            }
        }

        $requirements = $query->latest()->paginate(10)->withQueryString();

        return view('trader.requirements.index', compact('requirements'));
    }

    /**
     * Show the form for creating a new requirement.
     */
    public function create(): View
    {
        $varieties = CropVariety::orderBy('name')->get();

        return view('trader.requirements.create', compact('varieties'));
    }

    /**
     * Store a newly created requirement in storage.
     */
    public function store(RequirementRequest $request): RedirectResponse
    {
        $trader = Auth::user();

        $requirement = Requirement::create([
            'user_id' => $trader->id,
            'variety_id' => $request->variety_id,
            'quantity_required' => $request->quantity_required,
            'max_budget' => $request->max_budget,
            'description' => $request->description,
            'location' => $request->location ?? $trader->location,
            'is_active' => true,
        ]);

        return redirect()->route('trader.requirements.index')
            ->with('success', 'Requirement posted successfully!');
    }

    /**
     * Display the specified requirement.
     */
    public function show(Requirement $requirement): View
    {
        // Ensure the requirement belongs to the authenticated trader
        if ($requirement->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this requirement.');
        }

        $requirement->load('variety');

        return view('trader.requirements.show', compact('requirement'));
    }

    /**
     * Show the form for editing the specified requirement.
     */
    public function edit(Requirement $requirement): View
    {
        // Ensure the requirement belongs to the authenticated trader
        if ($requirement->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this requirement.');
        }

        $varieties = CropVariety::orderBy('name')->get();

        return view('trader.requirements.edit', compact('requirement', 'varieties'));
    }

    /**
     * Update the specified requirement in storage.
     */
    public function update(RequirementRequest $request, Requirement $requirement): RedirectResponse
    {
        // Ensure the requirement belongs to the authenticated trader
        if ($requirement->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this requirement.');
        }

        $requirement->update([
            'variety_id' => $request->variety_id,
            'quantity_required' => $request->quantity_required,
            'max_budget' => $request->max_budget,
            'description' => $request->description,
            'location' => $request->location,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('trader.requirements.index')
            ->with('success', 'Requirement updated successfully!');
    }

    /**
     * Remove the specified requirement from storage (soft delete).
     */
    public function destroy(Requirement $requirement): RedirectResponse
    {
        // Ensure the requirement belongs to the authenticated trader
        if ($requirement->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this requirement.');
        }

        $requirement->delete();

        return redirect()->route('trader.requirements.index')
            ->with('success', 'Requirement deleted successfully!');
    }

    /**
     * Toggle the active status of a requirement.
     */
    public function toggleStatus(Requirement $requirement): RedirectResponse
    {
        // Ensure the requirement belongs to the authenticated trader
        if ($requirement->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this requirement.');
        }

        $requirement->update([
            'is_active' => ! $requirement->is_active,
        ]);

        $status = $requirement->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Requirement {$status} successfully!");
    }
}
