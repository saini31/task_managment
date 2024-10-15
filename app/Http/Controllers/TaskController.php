<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Eager load the user relation for efficiency
        if ($user->role === 'admin' || $user->role === 'manager') {
            // Admin or manager can see all tasks
            $tasks = Task::with('user')->get();
        } else {
            // Regular users can only see their own tasks
            $tasks = Task::with('user')->where('user_id', $user->id)->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = collect();
        // If the user is an admin, fetch all users
        if (auth()->user()->role === 'admin') {
            $users = User::all(); // Fetch all users for admin role
        } elseif (auth()->user()->role === 'manager') {
            // Fetch only users with the 'user' role for manager role
            $users = User::where('role', 'user')->get();
        }

        if (auth()->user()->role === 'admin') {
            $users = $users->reject(function ($user) {
                return $user->role === 'admin'; // Exclude admin users from the collection
            });
        }
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,completed',
            'document' => 'nullable|file|max:10240', // Max 10MB
        ]);

        // Check if a document is uploaded and store it
        if ($request->hasFile('document')) {
            $validated['document_path'] = $request->file('document')->store('documents');
        }


        $authUser = auth()->user();
        $validated['assigned_by'] = $authUser->id;

        // Create a new task with the validated data
         Task::create($validated);
        //dd($rr);
        // Redirect to the task index with a success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,completed',
            'document' => 'required|file|max:10240',
        ]);

        if ($request->hasFile('document')) {
            // Delete old document if exists
            if ($task->document_path) {
                Storage::delete($task->document_path);
            }
            $validated['document_path'] = $request->file('document')->store('documents');
        }

        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
    public function download(Task $task)
    {
        // Check if the document exists
        if (!$task->document_path || !Storage::exists($task->document_path)) {
            return redirect()->back()->with('error', 'Document not found.');
        }

        // Return the document as a download response
        return Storage::download($task->document_path);
    }
    public function viewDocument(Task $task)
    {
        // Assuming the document is a PDF or image and stored in storage
        $path = storage_path('app/' . $task->document_path);

        // Check if the file exists
        if (file_exists($path)) {
            return response()->file($path);
        }

        return redirect()->back()->with('error', 'Document not found.');
    }
}
