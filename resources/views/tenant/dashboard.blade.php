@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Tenant Dashboard</h2>
            <p class="text-gray-600">Welcome, {{ auth()->user()->name }}! Organization: {{ $tenant->name }}</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Total Leads</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['total_leads'] }}</div>
                    <a href="{{ route('tenant.leads.index') }}" class="mt-2 text-sm text-indigo-600 hover:text-indigo-900">View all →</a>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Leads This Month</div>
                    <div class="mt-2 text-3xl font-semibold text-indigo-600">{{ $stats['leads_this_month'] }}</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Exhibitions</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['total_exhibitions'] }}</div>
                    <a href="{{ route('tenant.exhibitions.index') }}" class="mt-2 text-sm text-indigo-600 hover:text-indigo-900">View all →</a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <a href="{{ route('tenant.leads.create') }}" class="bg-indigo-600 text-white rounded-lg p-4 text-center hover:bg-indigo-700 transition">
                <div class="text-lg font-semibold">+ Add Lead</div>
                <div class="text-sm opacity-80">Capture new business lead</div>
            </a>
            <a href="{{ route('tenant.leads.index') }}" class="bg-green-600 text-white rounded-lg p-4 text-center hover:bg-green-700 transition">
                <div class="text-lg font-semibold">Manage Leads</div>
                <div class="text-sm opacity-80">View & edit all leads</div>
            </a>
            <a href="{{ route('tenant.exhibitions.create') }}" class="bg-purple-600 text-white rounded-lg p-4 text-center hover:bg-purple-700 transition">
                <div class="text-lg font-semibold">+ Add Exhibition</div>
                <div class="text-sm opacity-80">Create new event</div>
            </a>
            <a href="{{ route('tenant.exhibitions.index') }}" class="bg-orange-600 text-white rounded-lg p-4 text-center hover:bg-orange-700 transition">
                <div class="text-lg font-semibold">Exhibitions</div>
                <div class="text-sm opacity-80">Manage events & attendees</div>
            </a>
        </div>

        <!-- Recent Leads -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Recent Leads</h3>
                <a href="{{ route('tenant.leads.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">
                    Add Lead
                </a>
            </div>
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Source</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentLeads as $lead)
                            <tr>
                                <td class="px-4 py-2 text-sm">
                                    <a href="{{ route('tenant.leads.show', $lead) }}" class="text-indigo-600 hover:text-indigo-900">{{ $lead->name }}</a>
                                </td>
                                <td class="px-4 py-2 text-sm">{{ $lead->company ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm">{{ $lead->email ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm">{{ $lead->source ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @switch($lead->status_color)
                                            @case('blue') bg-blue-100 text-blue-800 @break
                                            @case('yellow') bg-yellow-100 text-yellow-800 @break
                                            @case('green') bg-green-100 text-green-800 @break
                                            @case('emerald') bg-emerald-100 text-emerald-800 @break
                                            @case('red') bg-red-100 text-red-800 @break
                                            @default bg-gray-100 text-gray-800
                                        @endswitch
                                    ">
                                        {{ $lead->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-500">No leads yet. Start by adding your first lead!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection