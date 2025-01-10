<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

// Route Login & Register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


// Proteksi Dashboard dengan Middleware Auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $cards = [
            [
                'title' => 'Users',
                'description' => 'Total Users',
                'total' => 120,
                'custom_class' => 'text-custom-color1',
                'icon' => 'fas fa-users',
                'route' => 'users.index'
            ],
            [
                'title' => 'Staff',
                'description' => 'Total Staff',
                'total' => 45,
                'custom_class' => 'text-custom-color2',
                'icon' => 'fas fa-user-tie',
                'route' => 'staff.index'
            ],
            [
                'title' => 'Customers',
                'description' => 'Total Customers',
                'total' => 350,
                'custom_class' => 'text-custom-color3',
                'icon' => 'fas fa-user',
                'route' => 'customers.index'
            ],
            [
                'title' => 'Orders',
                'description' => 'Total Orders',
                'total' => 90,
                'custom_class' => 'text-custom-color5',
                'icon' => 'fas fa-shopping-cart',
                'route' => 'orders.index'
            ],
            [
                'title' => 'Projects',
                'description' => 'Total Orders',
                'total' => 90,
                'custom_class' => 'text-custom-color4',
                'icon' => 'fas fa-briefcase',
                'route' => 'projects.index'
            ],
            [
                'title' => 'Tasks',
                'description' => 'Total Orders',
                'total' => 90,
                'custom_class' => 'text-custom-color5',
                'icon' => 'fas fa-tasks',
                'route' => 'tasks.index'
            ],
            [
                'title' => 'Finance',
                'description' => 'Total Orders',
                'total' => 90,
                'custom_class' => 'text-custom-color1',
                'icon' => 'fas fa-coins',
                'route' => 'finance.index'
            ],
            [
                'title' => 'Reports',
                'description' => 'Total Orders',
                'total' => 90,
                'custom_class' => 'text-custom-color6',
                'icon' => 'fas fa-file-alt',
                'route' => 'reports.index'
            ],
            [
                'title' => 'Log Activity',
                'description' => 'Total Orders',
                'total' => 90,
                'custom_class' => 'text-custom-color2',
                'icon' => 'fas fa-chart-line',
                'route' => 'activity.index'
            ],
            [
                'title' => 'Expenses',
                'description' => 'Total Orders',
                'total' => 90,
                'custom_class' => 'text-custom-color3',
                'icon' => 'fas fa-wallet',
                'route' => 'expenses.index'
            ],
        ];
        return view('dashboard', compact('cards'));
    })->name('dashboard');

    // Route User Management
    Route::resource('users', UserController::class);

    // Route Staff Management
    Route::resource('staff', StaffController::class);

    // Route Customer Management
    Route::resource('customers', CustomerController::class);

    // Route Order Management
    Route::resource('orders', OrderController::class);

    // Route Project Management
    Route::resource('projects', ProjectController::class);

    // Route Task Management
    Route::resource('tasks', TaskController::class);

    // Route Finance Management
    Route::resource('finance', FinanceController::class);

    // Route Report Management
    Route::resource('reports', ReportController::class);

    // Route Log Activity
    Route::resource('activity', ActivityController::class);

    // Route Expense Management
    Route::resource('expenses', ExpenseController::class);
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');