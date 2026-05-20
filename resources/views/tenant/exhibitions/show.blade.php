@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">{{ $exhibition->name }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('tenant.exhibitions.edit', $exhibition) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Edit</a>
                <a href="{{ route('tenant.exhibitions.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">← Back</a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ ucfirst($exhibition->status) }}</span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $exhibition->location ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Start Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $exhibition->start_date->format('M d, Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">End Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $exhibition->end_date?->format('M d, Y') ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Max Attendees</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $exhibition->max_attendees ?? 'Unlimited' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Attendees</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $exhibition->attendees->count() }}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $exhibition->description ?? 'No description' }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Attendees</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Checked In</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($exhibition->attendees as $attendee)
                        <tr>
                            <td class="px-4 py-2 text-sm">{{ $attendee->name }}</td>
                            <td class="px-4 py-2 text-sm">{{ $attendee->email ?? '-' }}</td>
                            <td class="px-4 py-2 text-sm">{{ $attendee->company ?? '-' }}</td>
                            <td class="px-4 py-2 text-sm">
                                @if($attendee->checked_in)
                                    <span class="text-green-600">✓ {{ $attendee->checked_in_at?->format('M d, H:i') }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-2 text-center text-gray-500">No attendees yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection