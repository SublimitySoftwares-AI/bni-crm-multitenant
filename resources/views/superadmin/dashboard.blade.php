@extends('layouts.app')

@section('title', 'Superadmin Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Total Tenants</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['total_tenants'] }}</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Active Tenants</div>
                    <div class="mt-2 text-3xl font-semibold text-green-600">{{ $stats['active_tenants'] }}</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Pending Tenants</div>
                    <div class="mt-2 text-3xl font-semibold text-yellow-600">{{ $stats['pending_tenants'] }}</div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Total Users</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $stats['total_users'] }}</div>
                </div>
            </div>
        </div>

        <!-- Recent Tenants -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Tenants</h3>
            </div>
            <div class="p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Domain</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Users</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentTenants as $tenant)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('tenants.show', $tenant) }}" class="text-indigo-600 hover:text-indigo-900">{{ $tenant->name }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tenant->domain ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($tenant->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tenant->users_count ?? 0 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('tenants.show', $tenant) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No tenants yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection