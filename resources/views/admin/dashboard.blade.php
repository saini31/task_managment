<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    {{-- Display the user role for debugging (optional) --}}
                    <p>Role: {{ Auth::user()->role }}</p>

                    {{-- Dynamic Content Based on User Role --}}
                    @if(Auth::user()->role === 'admin')
                    <div class="mt-4">
                        <h3 class="font-semibold text-lg">Admin Dashboard</h3>
                        <p>Welcome, Admin! Here you can manage users and view system reports.</p>
                        {{-- Add admin-specific links and functionalities here --}}
                        <a href="{{ route('admin.users') }}" class="text-blue-600 hover:underline">Manage Users</a>
                        <br>
                        <a href="{{ route('admin.reports') }}" class="text-blue-600 hover:underline">View Reports</a>
                    </div>
                      @endif
                  
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>