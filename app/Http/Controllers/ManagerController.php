<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    // Display a list of tasks
    public function index()
    {
        $tasks = Task::all(); // Fetch all tasks
        return view('tasks.index', compact('tasks'));
    }

    // View a specific task
    public function show($id)
    {
        $task = Task::findOrFail($id); // Fetch task by ID
        return view('manager.tasks.show', compact('task'));
    }

    // Handle task creation
    public function create()
    {
        return view('manager.tasks.create'); // Show task creation form
    }

    // Store new task
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,completed',
        ]);

        Task::create($validatedData); // Create a new task

        return redirect()->route('manager.tasks')->with('success', 'Task created successfully.');
    }

    // Manage team (this could include assigning users to tasks, etc.)
    public function team()
    {
        // Fetch team members or any related data
        return view('manager.team.index'); // Show team management view
    }
}
