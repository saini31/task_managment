<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;

/*
|--------------------------------------------------------------------------
// Web Routes
|--------------------------------------------------------------------------
// Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Task Routes (accessible by user, admin, manager)
Route::middleware(['auth', 'role:user,admin,manager'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

// Admin Routes (accessible only by admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users'); // View all users
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create'); // Show user creation form
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store'); // Store new user
    Route::get('/admin/users/{id}', [AdminController::class, 'show'])->name('admin.users.show'); // Show user details
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit'); // Show user edit form
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update'); // Update user
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy'); // Delete user
    
});

// User Task Routes (accessible by user and admin)
Route::middleware(['auth', 'role:user,admin'])->group(function () {
    Route::get('/user/tasks', [TaskController::class, 'index'])->name('user.tasks'); // View user tasks
    Route::get('/user/tasks/create', [TaskController::class, 'create'])->name('user.tasks.create'); // Show create task form
    Route::post('/user/tasks', [TaskController::class, 'store'])->name('user.tasks.store'); // Store new task
    Route::get('/user/tasks/{id}', [TaskController::class, 'show'])->name('user.tasks.show'); // Show task details
    Route::get('/user/tasks/{id}/edit', [TaskController::class, 'edit'])->name('user.tasks.edit'); // Show edit task form
    Route::put('/user/tasks/{id}', [TaskController::class, 'update'])->name('user.tasks.update'); // Update task
    Route::delete('/user/tasks/{id}', [TaskController::class, 'destroy'])->name('user.tasks.destroy'); // Delete task
    Route::get('/tasks/{task}/download', [TaskController::class, 'download'])->name('tasks.download'); // Download task
    Route::get('/tasks/{task}/view', [TaskController::class, 'viewDocument'])->name('tasks.view'); // View task document
});

// Manager Routes (accessible by manager and admin)
Route::middleware(['auth', 'role:manager,admin'])->group(function () {
    Route::get('/manager/tasks', [ManagerController::class, 'index'])->name('manager.tasks'); // View all tasks
    Route::get('/manager/tasks/create', [ManagerController::class, 'create'])->name('manager.tasks.create'); // Show task creation form
    Route::post('/manager/tasks', [ManagerController::class, 'store'])->name('manager.tasks.store'); // Store new task
    Route::get('/manager/tasks/{id}', [ManagerController::class, 'show'])->name('manager.tasks.show'); // Show task details
    Route::get('/manager/team', [ManagerController::class, 'team'])->name('manager.team'); // Manage team
});

// Include authentication routes
require __DIR__ . '/auth.php';
