<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ReportsController;

Route::get('/', function () {
    return view('welcome');
});


// Membership Routes

Route::get('/memberships', [MembershipController::class, 'index'])
    ->name('memberships.index');

Route::post('/memberships', [MembershipController::class, 'store'])
    ->name('memberships.store');

Route::put('/memberships/{id}', [MembershipController::class, 'update'])
    ->name('memberships.update');

Route::delete('/memberships/{id}', [MembershipController::class, 'destroy'])
    ->name('memberships.destroy');


// Subscription Routes

Route::get('/subscriptions', [SubscriptionController::class, 'index'])
    ->name('subscriptions.index');

Route::post('/subscriptions', [SubscriptionController::class, 'store'])
    ->name('subscriptions.store');

Route::put('/subscriptions/{id}', [SubscriptionController::class, 'update'])
    ->name('subscriptions.update');

Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'destroy'])
    ->name('subscriptions.destroy');

    // Members Routes
Route::get('/members', [MemberController::class, 'index'])
    ->name('members.index');

Route::post('/members', [MemberController::class, 'store'])
    ->name('members.store');

Route::put('/members/{id}', [MemberController::class, 'update'])
    ->name('members.update');

Route::delete('/members/{id}', [MemberController::class, 'destroy'])
    ->name('members.destroy');

    // Appointments Routes

Route::get('/appointments', [AppointmentController::class, 'index'])
    ->name('appointments.index');

Route::post('/appointments', [AppointmentController::class, 'store'])
    ->name('appointments.store');

Route::put('/appointments/{id}', [AppointmentController::class, 'update'])
    ->name('appointments.update');

Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])
    ->name('appointments.destroy');

    // Reports Routes

Route::get('/reports', [ReportsController::class, 'index'])
    ->name('reports.index');

Route::get('/reports/export', [ReportsController::class, 'export'])
    ->name('reports.export');