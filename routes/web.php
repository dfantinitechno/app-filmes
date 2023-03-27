<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPostController;
use Illuminate\Support\Facades\Route;

Route::get('/interacoes', function () {
    return view('interacoes');
})->middleware(['auth', 'verified'])->name('interacoes');

Route::middleware('auth')->group(function () {
    Route::get('/feed', [PostsController::class, 'show'])->name('feed');
    Route::get('/follow', [UserPostController::class, 'show'])->name('follow');
    Route::get('/new', [PostsController::class, 'create'])->name('new');
    Route::post('/new', [PostsController::class, 'store'])->name('new_post');
    Route::post('/vote/{id}', [UserPostController::class, 'store'])->name('new_vote');

    Route::put('/posts/{id}', [PostsController::class, 'finish'])->name('finish');

    Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
