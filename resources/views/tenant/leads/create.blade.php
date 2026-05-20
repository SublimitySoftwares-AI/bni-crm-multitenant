@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Lead</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('tenant.leads.store') }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Company</label>
                    <input type="text" name="company" value="{{ old('company') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Designation</label>
                    <input type="text" name="designation" value="{{ old('designation') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Source</label>
                    <select name="source" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Select source...</option>
                        <option value="exhibition" {{ old('source') == 'exhibition' ? 'selected' : '' }}>Exhibition</option>
                        <option value="referral" {{ old('source') == 'referral' ? 'selected' : '' }}>Referral</option>
                        <option value="website" {{ old('source') == 'website' ? 'selected' : '' }}>Website</option>
                        <option value="card_scan" {{ old('source') == 'card_scan' ? 'selected' : '' }}>Card Scan</option>
                        <option value="cold_call" {{ old('source') == 'cold_call' ? 'selected' : '' }}>Cold Call</option>
                        <option value="other" {{ old('source') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
                    <textarea name="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('tenant.leads.index') }}" class="mr-4 px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                    Save Lead
                </button>
            </div>
        </form>
    </div>
</div>
@endsection