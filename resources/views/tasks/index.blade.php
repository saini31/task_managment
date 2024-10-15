<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="py-6">
                        <div class="container mx-auto">
                            <h1 class="text-center mb-6 text-2xl font-bold text-blue-600 dark:text-blue-400">Tasks</h1>

                            <!-- Center the button with some margin and shadow -->
                            <div class="flex justify-center mb-5">
                                <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300 shadow-lg">
                                    Create Task
                                </a>
                            </div>

                            <!-- Make table responsive for different screen sizes with a modern style -->
                            <div class="overflow-x-auto shadow-lg rounded-lg">
                                <table class="min-w-full bg-white dark:bg-gray-700 table-auto text-center">
                                    <thead class="bg-gray-100 dark:bg-gray-800">
                                        <tr class="text-gray-600 dark:text-gray-300">
                                            <th class="px-4 py-2">Title</th>
                                            <th class="px-4 py-2">Description</th>
                                            <th class="px-4 py-2">Priority</th>
                                            <th class="px-4 py-2">Assigned by</th>
                                            <th class="px-4 py-2">Deadline</th>
                                            <th class="px-4 py-2">Status</th>
                                            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                                            <th class="px-4 py-2">Assigned User</th>
                                            @endif
                                            <th class="px-4 py-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                        <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-200">
                                            <td class="px-4 py-3">{{ $task->title }}</td>
                                            <td class="px-4 py-3">{{ $task->description }}</td>
                                            <td class="px-4 py-3">
                                                <span class="inline-block px-2 py-1 rounded text-white 
                                                    {{ $task->priority == 'high' ? 'bg-red-500' : ($task->priority == 'medium' ? 'bg-yellow-500' : 'bg-green-500') }}">
                                                    {{ ucfirst($task->priority) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($task->assigned_by)
                                                <span>{{ \App\Models\User::find($task->assigned_by)->name }}</span>
                                                @else
                                                <span class="text-gray-500">N/A</span>
                                                @endif
                                            </td>

                                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}</td>
                                            <td class="px-4 py-3">
                                                <span class="inline-block px-2 py-1 rounded text-white 
                                                    {{ $task->status == 'completed' ? 'bg-green-500' : 'bg-gray-400' }}">
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                            </td>
                                            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                                            <td class="px-4 py-3">{{ $task->user ? $task->user->name : 'N/A' }}</td>
                                            @endif
                                            <td class="px-4 py-3 flex justify-center space-x-2">
                                                <a href="{{ route('tasks.edit', $task) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 transition duration-200">Edit</a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition duration-200" onclick="return confirm('Are you sure you want to delete this task?');">
                                                        Delete
                                                    </button>
                                                </form>
                                                @if ($task->document_path)
                                                <a href="{{ route('tasks.view', $task) }}" class="bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600 transition duration-200">View Document</a>
                                                <a href="{{ route('tasks.download', $task) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 transition duration-200">Download Document</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>