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

                    {{-- Dynamic Content Based on User Role --}}
                    @if (Auth::user()->role === 'admin')
                    <div class="mt-4">
                        <h3 class="font-semibold text-lg">Admin Dashboard</h3>
                        <p>Welcome, Admin! Here you can manage users and view system reports.</p>
                        <a href="{{ route('admin.users') }}" class="text-blue-600 hover:underline">Manage Users</a>
                        <br>
                        <a href="{{ route('manager.tasks') }}" class="text-blue-600 hover:underline">View Tasks</a>
                        <br>

                    </div>

                    @elseif (Auth::user()->role === 'manager')
                    <div class="mt-4">
                        <h3 class="font-semibold text-lg">Manager Dashboard</h3>
                        <p>Welcome, Manager! Here you can oversee tasks and manage team members.</p>
                        <a href="{{ route('manager.tasks') }}" class="text-blue-600 hover:underline">View Tasks</a>
                        <br>

                    </div>

                    @elseif (Auth::user()->role === 'user')
                    <div class="mt-4">
                        <h3 class="font-semibold text-lg">User Dashboard</h3>
                        <p>Welcome! Here you can view and manage your tasks.</p>
                        <a href="{{ route('user.tasks') }}" class="text-blue-600 hover:underline">My Tasks</a>
                        <br>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>