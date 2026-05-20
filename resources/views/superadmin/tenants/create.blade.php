@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Tenant</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tenants.store') }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <h3 class="text-lg font-semibold mb-4 text-gray-700">Tenant Information</h3>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tenant Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Domain (optional)</label>
                <input type="text" name="domain" value="{{ old('domain') }}" placeholder="tenant.example.com" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">FQDN (optional)</label>
                <input type="text" name="fqdn" value="{{ old('fqdn') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <hr class="my-6">

            <h3 class="text-lg font-semibold mb-4 text-gray-700">Admin User</h3>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Admin Name *</label>
                <input type="text" name="admin_name" value="{{ old('admin_name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Admin Email *</label>
                <input type="email" name="admin_email" value="{{ old('admin_email') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Admin Password *</label>
                <input type="password" name="admin_password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('tenants.index') }}" class="mr-4 px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                    Create Tenant
                </button>
            </div>
        </form>
    </div>
</div>
@endsection