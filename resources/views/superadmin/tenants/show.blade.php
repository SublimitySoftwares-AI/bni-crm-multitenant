@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">{{ $tenant->name }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('tenants.index') }}" class="text-gray-600 hover:text-gray-800">← Back</a>
                @if($tenant->is_active)
                    <a href="{{ route('tenants.suspend', $tenant) }}" class="text-yellow-600 hover:text-yellow-800 px-3 py-1 border border-yellow-400 rounded">Suspend</a>
                @else
                    <a href="{{ route('tenants.activate', $tenant) }}" class="text-green-600 hover:text-green-800 px-3 py-1 border border-green-400 rounded">Activate</a>
                @endif
            </div>
        </div>

        <!-- Tenant Details -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Tenant Details</h3>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $tenant->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        @if($tenant->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Domain</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $tenant->domain ?? 'Not set' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Database</dt>
                    <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $tenant->database }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Created</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $tenant->created_at->format('M d, Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $tenant->updated_at->format('M d, Y') }}</dd>
                </div>
            </dl>
        </div>

        <!-- Users -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Users</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($tenant->tenantUsers as $tu)
                        <tr>
                            <td class="px-4 py-2 text-sm">{{ $tu->user->name }}</td>
                            <td class="px-4 py-2 text-sm">{{ $tu->user->email }}</td>
                            <td class="px-4 py-2 text-sm">{{ $tu->role }}</td>
                            <td class="px-4 py-2 text-sm">{{ $tu->joined_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">No users yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection