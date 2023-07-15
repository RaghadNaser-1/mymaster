<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\BorrowController;




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
Route::get('/repository', [HomeController::class, 'repository'])->name('repository');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/repository/search', [HomeController::class, 'search'])->name('repository.search');
Route::post('/repository/store', [HomeController::class, 'store'])->name('repository.store');


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
Route::get('/users', [DashboardController::class, 'users'])->name('userstable');
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


Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
// Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

Route::get('/repositories', [RepositoryController::class, 'index'])->name('repositories.index');
Route::get('/repositories/create', [RepositoryController::class, 'create'])->name('repositories.create');
Route::post('/repositories', [RepositoryController::class, 'store'])->name('repositories.store');
// Route::get('/repositories/{repository}', [RepositoryController::class, 'show'])->name('repositories.show');
Route::get('/repositories/{repository}/edit', [RepositoryController::class, 'edit'])->name('repositories.edit');
Route::put('/repositories/{repository}', [RepositoryController::class, 'update'])->name('repositories.update');
Route::delete('/repositories/{repository}', [RepositoryController::class, 'destroy'])->name('repositories.destroy');

Route::get('/borrows', [BorrowController::class, 'index'])->name('borrows.index');
Route::get('/borrows/create', [BorrowController::class, 'create'])->name('borrows.create');
Route::post('/borrows', [BorrowController::class, 'store'])->name('borrows.store');
Route::get('/borrows/{borrow}/edit', [BorrowController::class, 'edit'])->name('borrows.edit');
Route::put('/borrows/{borrow}', [BorrowController::class, 'update'])->name('borrows.update');
Route::delete('/borrows/{borrow}', [BorrowController::class, 'destroy'])->name('borrows.destroy');
Route::get('/borrows/{borrow}/return', [BorrowController::class, 'return'])->name('borrows.return');

// Route::post('/books/{book}/favorite', [BookController::class, 'favorite'])->name('books.favorite');
Route::get('/books/{book}/favorite', [BookController::class, 'favorite'])->name('books.favorite');
Route::get('/books/{book}/unfavorite', [BookController::class, 'unfavorite'])->name('books.unfavorite');

