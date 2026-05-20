@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">{{ $lead->name }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('tenant.leads.edit', $lead) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Edit</a>
                <a href="{{ route('tenant.leads.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">← Back</a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $lead->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $lead->email ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $lead->phone ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Company</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $lead->company ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Designation</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $lead->designation ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Source</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $lead->source ?? '-' }}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Notes</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $lead->notes ?? 'No notes' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Created</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $lead->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $lead->updated_at->format('M d, Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection