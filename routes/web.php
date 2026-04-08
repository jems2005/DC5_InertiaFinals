<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('home');

// Auth routes (login, register, logout handled by Laravel's built-in auth)
Route::middleware('guest')->group(function () {
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/login', function () {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt(request()->only('email', 'password'), request('remember'))) {
            return redirect(route('dashboard'));
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    });
    Route::post('/register', function () {
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        \App\Models\User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'role' => 'employee',
        ]);
        auth()->attempt(request()->only('email', 'password'));
        return redirect(route('dashboard'));
    });
});

// Profile routes (protected)
Route::middleware('auth')->group(function () {
    Route::inertia('/profile/edit', 'Profile/Edit')->name('profile.edit');
    Route::patch('/profile', function () {
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        ]);
        auth()->user()->update(request()->only('name', 'email'));
        return back();
    })->name('profile.update');
    Route::put('/password', function () {
        request()->validate([
            'current_password' => ['required', 'current_password'],
            'password' => 'required|string|min:8|confirmed',
        ]);
        auth()->user()->update([
            'password' => bcrypt(request('password')),
        ]);
        return back();
    })->name('password.update');
    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// Auth protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Inventory - view only for employees
    Route::resource('inventory', InventoryController::class)
        ->only(['index', 'show']);

    // Requests - create/view for all auth users
    Route::resource('requests', RequestController::class)
        ->only(['index', 'create', 'store', 'show']);
});

// Admin only routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Inventory - full CRUD for admins
    Route::resource('inventory', InventoryController::class)
        ->except(['index', 'show']);

    // Request approve/reject
    Route::patch('requests/{request}/approve', [RequestController::class, 'approve'])
        ->name('requests.approve');
    Route::patch('requests/{request}/reject', [RequestController::class, 'reject'])
        ->name('requests.reject');
});
