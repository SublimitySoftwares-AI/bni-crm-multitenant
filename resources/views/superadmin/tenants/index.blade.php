@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Tenants</h2>
            <a href="{{ route('tenants.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Create Tenant
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Domain</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Database</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Users</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tenants as $tenant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('tenants.show', $tenant) }}" class="text-indigo-600 hover:text-indigo-900">{{ $tenant->name }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tenant->domain ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono text-xs">{{ $tenant->database }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($tenant->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tenant->users_count ?? 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('tenants.edit', $tenant) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <a href="{{ route('tenants.show', $tenant) }}" class="text-gray-600 hover:text-gray-900 mr-3">View</a>
                                @if($tenant->is_active)
                                    <a href="{{ route('tenants.suspend', $tenant) }}" class="text-yellow-600 hover:text-yellow-900">Suspend</a>
                                @else
                                    <a href="{{ route('tenants.activate', $tenant) }}" class="text-green-600 hover:text-green-900">Activate</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No tenants found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t">
                {{ $tenants->links() }}
            </div>
        </div>
    </div>
</div>
@endsection