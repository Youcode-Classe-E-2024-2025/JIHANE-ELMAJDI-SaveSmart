<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\FamilyAccountController;
use App\Http\Controllers\SavingsGoalController;
use App\Http\Controllers\BudgetOptimizationController;
use App\Http\Controllers\ExportController;

// Public routes
Route::get('/', function () { return view('home'); })->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TransactionController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', function () { return view('profile'); })->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Transaction routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    // Family Account routes
    Route::get('/family', [FamilyAccountController::class, 'index'])->name('family.index');
    Route::get('/family/create', [FamilyAccountController::class, 'create'])->name('family.create');
    Route::post('/family', [FamilyAccountController::class, 'store'])->name('family.store');
    Route::get('/family/{familyAccount}', [FamilyAccountController::class, 'show'])->name('family.show');
    Route::post('/family/{familyAccount}/members', [FamilyAccountController::class, 'addMember'])->name('family.members.add');
    Route::delete('/family/{familyAccount}/members/{user}', [FamilyAccountController::class, 'removeMember'])->name('family.members.remove');

    // Savings Goals routes
    Route::get('/savings', [SavingsGoalController::class, 'index'])->name('savings.index');
    Route::post('/savings', [SavingsGoalController::class, 'store'])->name('savings.store');
    Route::put('/savings/{goal}', [SavingsGoalController::class, 'update'])->name('savings.update');
    Route::put('/savings/{goal}/cancel', [SavingsGoalController::class, 'cancel'])->name('savings.cancel');
    Route::delete('/savings/{goal}', [SavingsGoalController::class, 'destroy'])->name('savings.destroy');

    // Budget Optimization routes
    Route::get('/budget/optimization', [BudgetOptimizationController::class, 'index'])->name('budget.optimization');
    
    // Export routes
    Route::get('/export/pdf', [ExportController::class, 'exportPdf'])->name('export.pdf');
    Route::get('/export/csv', [ExportController::class, 'exportCsv'])->name('export.csv');
});

