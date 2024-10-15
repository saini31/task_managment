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



                    @if(Auth::user()->role === 'manager')
                    <div class="mt-4">
                        <h3 class="font-semibold text-lg">Manager Dashboard</h3>
                        <p>Welcome, Manager! Here you can oversee tasks and manage team members.</p>
                        {{-- Add manager-specific links and functionalities here --}}
                        <a href="{{ route('manager.tasks') }}" class="text-blue-600 hover:underline">View Tasks</a>
                        <br>
                        <a href="{{ route('manager.team') }}" class="text-blue-600 hover:underline">Manage Team</a>
                    </div>


                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>