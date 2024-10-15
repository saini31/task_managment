<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('admin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create'); // Create a view for user creation
    }

    public function store(Request $request)
    {
        // Validate and store new user
    }

    public function show($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        return view('admin.users.show', compact('user')); // Show user details
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        return view('admin.edit', compact('user')); // Show user edit form
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // Validate and update the user information
        $user->update($request->all());
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function reports()
    {
        // Return view for reports
    }
}
