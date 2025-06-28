<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SidebarController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
	if (Auth::check()) {
		return redirect()->route('administrator.dashboard');
	}
	return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
	Route::get('/login', [AuthController::class,'showLogin'])->name('login');
	Route::post('/login', [AuthController::class,'login']);
	Route::get('/signup', [AuthController::class,'showSignup'])->name('signup');
	Route::post('/signup', [AuthController::class,'signup'])->name('signup.post');
	Route::get('/change-password', [AuthController::class,'showChangePassword'])->name('change-password');
	Route::post('/change-password', [AuthController::class,'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
	Route::post('/logout', [AuthController::class,'logout'])->name('logout');

	Route::get('/administrator/dashboard', [DashboardController::class, 'showDashboard'])->name('administrator.dashboard');
	Route::get('/allocate-budget', [DashboardController::class,'showAllocateBudget'])->name('allocate-budget');
	Route::get('/expense-history', [DashboardController::class,'showExpenseHistory'])->name('expense-history');
	Route::get('/budget-statistics', [DashboardController::class,'showBudgetStatistics'])->name('budget-statistics');
	Route::get('/data-record-counting-year', [DashboardController::class,'showDataRecordCountingYear'])->name('data-record-counting-year');
	Route::get('/gl-list', [DashboardController::class,'showGlList'])->name('gl-list');
	Route::get('/apply-sb', [DashboardController::class,'showApplySb'])->name('apply-sb');

	Route::get('/notifications', [SidebarController::class,'showNotifications'])->name('notifications');
	Route::get('/user-list', [SidebarController::class,'showUserList'])->name('user-list');
	Route::get('/tariff-lists', [SidebarController::class,'showTariffLists'])->name('tariff-lists');
	Route::put('/tariff-lists', [SidebarController::class,'updateTariffLists'])->name('tariff-lists.update');
	Route::get('/client-list', [SidebarController::class,'showClientList'])->name('client-list');
	Route::get('/client-registration/create', [SidebarController::class,'showAppFormInput'])->name('client.registration.create');
	Route::post('/client-applications', [SidebarController::class,'storeClientApplication'])->name('client.profile.store');
	Route::get('/sms-presets', [SidebarController::class,'showSmsPresets'])->name('sms-presets');
	Route::get('/logs-and-reports', [SidebarController::class,'showLogsAndReports'])->name('logs-and-reports');
	Route::get('/archive', [SidebarController::class,'showArchive'])->name('archive');

	Route::get('/client/{id}/profile', [ClientProfileController::class, 'show'])->name('client.profile.show');
	Route::put('/client/{id}/profile', [ClientProfileController::class, 'update'])->name('client.profile.update');
	Route::delete('/client/{id}/profile', [ClientProfileController::class,'destroy'])->name('client.profile.destroy');

	Route::get('/user-profile', [UserProfileController::class,'show'])->name('user.profile.show');
	Route::put('/user-profile', [UserProfileController::class,'update'])->name('user.profile.update');
	Route::delete('/user-profile', [UserProfileController::class,'destroy'])->name('user.profile.destroy');
});