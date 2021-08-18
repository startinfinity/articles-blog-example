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


use App\Http\Controllers\ArticlesController;
Route::get('/', [ArticlesController::class, 'index'])->name('articles');
Route::get('create', [ArticlesController::class, 'postForm'])->name('articles-create');
Route::get('{slug}', [ArticlesController::class, 'singleArticle'])->name('article');
Route::post('article-post-comment', [ArticlesController::class, 'postComment'])->name('artice-post-comment');
Route::post('article-post-like', [ArticlesController::class, 'postLike'])->name('artice-post-like');

