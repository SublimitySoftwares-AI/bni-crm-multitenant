@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Leads</h2>
            <a href="{{ route('tenant.leads.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Add Lead
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" class="bg-white shadow-sm rounded-lg p-4 mb-6">
            <div class="flex gap-4 flex-wrap">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, company, email, phone..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <select name="source" class="px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">All Sources</option>
                    <option value="exhibition" {{ request('source') == 'exhibition' ? 'selected' : '' }}>Exhibition</option>
                    <option value="referral" {{ request('source') == 'referral' ? 'selected' : '' }}>Referral</option>
                    <option value="website" {{ request('source') == 'website' ? 'selected' : '' }}>Website</option>
                    <option value="card_scan" {{ request('source') == 'card_scan' ? 'selected' : '' }}>Card Scan</option>
                </select>
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-900">Filter</button>
                <a href="{{ route('tenant.leads.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Clear</a>
            </div>
        </form>

        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Source</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($leads as $lead)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('tenant.leads.show', $lead) }}" class="text-indigo-600 hover:text-indigo-900">{{ $lead->name }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->company ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->email ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->phone ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $lead->source ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('tenant.leads.edit', $lead) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('tenant.leads.destroy', $lead) }}" method="POST" class="inline" onsubmit="return confirm('Delete this lead?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No leads found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t">
                {{ $leads->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
