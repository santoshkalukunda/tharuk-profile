<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resources([
    'profiles' => \App\Http\Controllers\ProfileController::class,
]);

Route::get('test', function () {
    $user = \App\Models\User::create([
        'first_name' => 'first_name',
        'last_name' => 'last_name',
        'email' => 'email',
        'password' => Hash::make('password'),
        'dob' => 'dob',
        'gender' => 'gender'
    ]);

    $user->profile()->create();
    return $user;
    $user = \App\Models\User::first();
    return $user->profile()->create();
});
// Route::view('dashboard', 'dashboard-theme');