<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ActivityReportController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Member Management (Admin Only)
    Route::middleware(['auth'])->group(function() {
        Route::put('members/{id}/status', [MemberController::class, 'updateStatus'])->name('members.updateStatus');
        Route::resource('members', MemberController::class);
    });

    // Savings & Loans
    Route::get('savings/history', [SavingController::class, 'history'])->name('savings.history');
    Route::resource('savings', SavingController::class);
    Route::resource('loans', LoanController::class);
    Route::post('loans/{loan}/approve', [LoanController::class, 'approve'])->name('loans.approve');
    Route::post('loans/{loan}/reject', [LoanController::class, 'reject'])->name('loans.reject');
    // Reports
    Route::get('reports/activity', [ActivityReportController::class, 'index'])->name('reports.activity');
    Route::get('reports/savings', [ReportController::class, 'savingsReport'])->name('reports.savings');
    Route::get('reports/savings/pdf', [ReportController::class, 'exportSavingsPDF'])->name('reports.savings.pdf');
    Route::get('reports/loans', [ReportController::class, 'loansReport'])->name('reports.loans');
    Route::get('reports/loans/pdf', [ReportController::class, 'exportLoansPDF'])->name('reports.loans.pdf');
});

require __DIR__.'/auth.php';
