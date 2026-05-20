<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of leads.
     */
    public function index(Request $request)
    {
        $query = Lead::query();

        // Apply filters
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('company', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        $leads = $query->latest()->paginate(20)->withQueryString();

        return view('tenant.leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new lead.
     */
    public function create()
    {
        return view('tenant.leads.create');
    }

    /**
     * Store a newly created lead.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ]);

        Lead::create($validated);

        return redirect()->route('tenant.leads.index')
            ->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified lead.
     */
    public function show(Lead $lead)
    {
        return view('tenant.leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified lead.
     */
    public function edit(Lead $lead)
    {
        return view('tenant.leads.edit', compact('lead'));
    }

    /**
     * Update the specified lead.
     */
    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ]);

        $lead->update($validated);

        return redirect()->route('tenant.leads.show', $lead)
            ->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified lead.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('tenant.leads.index')
            ->with('success', 'Lead deleted successfully.');
    }
}