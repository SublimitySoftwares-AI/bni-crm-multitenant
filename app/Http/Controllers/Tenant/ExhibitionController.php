<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Exhibition;
use App\Models\ExhibitionAttendee;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    /**
     * Display a listing of exhibitions.
     */
    public function index(Request $request)
    {
        $query = Exhibition::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $exhibitions = $query->withCount('attendees')->latest()->paginate(20)->withQueryString();

        return view('tenant.exhibitions.index', compact('exhibitions'));
    }

    /**
     * Show the form for creating a new exhibition.
     */
    public function create()
    {
        return view('tenant.exhibitions.create');
    }

    /**
     * Store a newly created exhibition.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'max_attendees' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable', 'string', 'in:draft,published,ongoing,completed,cancelled'],
        ]);

        $validated['status'] = $validated['status'] ?? 'draft';

        Exhibition::create($validated);

        return redirect()->route('tenant.exhibitions.index')
            ->with('success', 'Exhibition created successfully.');
    }

    /**
     * Display the specified exhibition.
     */
    public function show(Exhibition $exhibition)
    {
        $exhibition->load('attendees');
        return view('tenant.exhibitions.show', compact('exhibition'));
    }

    /**
     * Show the form for editing the specified exhibition.
     */
    public function edit(Exhibition $exhibition)
    {
        return view('tenant.exhibitions.edit', compact('exhibition'));
    }

    /**
     * Update the specified exhibition.
     */
    public function update(Request $request, Exhibition $exhibition)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'max_attendees' => ['nullable', 'integer', 'min:1'],
            'status' => ['nullable', 'string', 'in:draft,published,ongoing,completed,cancelled'],
        ]);

        $exhibition->update($validated);

        return redirect()->route('tenant.exhibitions.show', $exhibition)
            ->with('success', 'Exhibition updated successfully.');
    }

    /**
     * Remove the specified exhibition.
     */
    public function destroy(Exhibition $exhibition)
    {
        $exhibition->delete();

        return redirect()->route('tenant.exhibitions.index')
            ->with('success', 'Exhibition deleted successfully.');
    }
}