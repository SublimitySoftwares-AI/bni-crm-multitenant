{{-- This view intentionally left blank - using welcome.blade.php --}}
<x-guest-layout>
    <div class="text-center">
        <h1 class="text-4xl font-bold text-indigo-600 mb-4">BNI CRM</h1>
        <p class="text-xl text-gray-600 mb-8">Multitenant CRM for Business Networking</p>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Login</a>
            <a href="{{ route('register') }}" class="inline-block px-6 py-3 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50">Register</a>
        </div>
    </div>
</x-guest-layout>