<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [HomeController::class, 'index'])->name('index');

// Route::get('/index', function () {
//     return view('index');
// });

Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::post('/submit-signup', [AuthController::class, 'signup'])->name('submit.signup');
Route::post('/login', [AuthController::class, 'login'])->name('submit.login');
// Route::post('/logout', [AuthController::class],'logout')->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/clear-welcome-message', function () {
    session()->forget('welcome_message');
    return redirect()->back();

    // return response()->json(['message' => 'Welcome message cleared successfully']);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/users', [DashboardController::class, 'users'])->name('users');

Route::get('/books', [BookController::class, 'index'])->name('books.index');


