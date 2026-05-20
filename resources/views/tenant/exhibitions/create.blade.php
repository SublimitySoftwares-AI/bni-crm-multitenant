@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Exhibition</h2>

        <form method="POST" action="{{ route('tenant.exhibitions.store') }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Start Date *</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Max Attendees</label>
                    <input type="number" name="max_attendees" value="{{ old('max_attendees') }}" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('tenant.exhibitions.index') }}" class="mr-4 px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection