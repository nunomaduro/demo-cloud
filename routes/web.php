<?php

use App\Models\User;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

// create a status endpoint that query the databases:
Route::get('/status', function () {
    $time = Benchmark::measure(function () {
        User::factory()->create();
    });

    return response()->json([
        'status' => 200,
        'timeDoingAnInsert' => $time,
        'usersCount' => User::query()->count(),
    ]);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
