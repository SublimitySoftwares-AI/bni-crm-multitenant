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
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
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
                    </dd>
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

            <!-- Change Status Form -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Status</h3>
                <form action="{{ route('tenant.leads.changeStatus', $lead) }}" method="POST" class="flex gap-4 items-end">
                    @csrf
                    <div class="flex-1">
                        <label for="status" class="block text-sm font-medium text-gray-700">New Status</label>
                        <select name="status" id="status" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach($lead->getStatuses() as $key => $label)
                                <option value="{{ $key }}" {{ $lead->status == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
