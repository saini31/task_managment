<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl leading-tight text-gray-800 dark:text-gray-200">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-6 text-3xl font-bold text-center text-blue-600">Create Task</h1>

                    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium mb-1">Title</label>
                            <input type="text" id="title" name="title" class="form-input mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium mb-1">Description</label>
                            <textarea id="description" name="description" class="form-textarea mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-sm" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="priority" class="block text-sm font-medium mb-1">Priority</label>
                            <select id="priority" name="priority" class="form-select mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>Select Priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="deadline" class="block text-sm font-medium mb-1">Deadline</label>
                            <input type="date" id="deadline" name="deadline" class="form-input mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium mb-1">Status</label>
                            <select id="status" name="status" class="form-select mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <!-- User Assignment -->
                        @if(auth()->user()->role === 'manager' || auth()->user()->role === 'admin')
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium mb-1">Assign To</label>
                            <select id="user_id" name="user_id" class="form-select mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>Select User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        @endif

                        <div class="mb-4">
                            <label for="document" class="block text-sm font-medium mb-1">Attach Document</label>
                            <input type="file" id="document" name="document" class="form-input mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md shadow-sm">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Create Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>