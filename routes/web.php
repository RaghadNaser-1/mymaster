<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;



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
})->name('login');


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
Route::get('/bookstable', [DashboardController::class, 'books'])->name('bookstable');


Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class,'show'])->name('books.show');
Route::post('/books/{book}/borrow', [BookController::class,'borrow'])->name('books.borrow');
// Route::resource('books', BookController::class);
Route::resource('dashboard.books', BookController::class);
Route::delete('/dashboard/books/{book}', [BookController::class, 'destroy'])->name('dashboard.books.destroy');
Route::get('/dashboard/books/{book}/edit', [BookController::class, 'edit'])->name('dashboard.books.edit');
Route::put('/dashboard/books/{book}', [BookController::class, 'update'])->name('dashboard.books.update');

// Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
Route::get('/author/{id}', [AuthorController::class,'show'])->name('author.show');


