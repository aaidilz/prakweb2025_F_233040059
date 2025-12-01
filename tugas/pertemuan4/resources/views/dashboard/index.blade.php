<x-dashboard-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>

    <h1 class="text-4xl font-bold text-gray-800 mb-4">
        Welcome, {{ auth()->check() ? auth()->user()->name : 'Guest' }}
    </h1>

    <!-- logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition-colors duration-300">
            Logout
        </button>

    @include('components.table')
</x-dashboard-layout>
