<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('posts.index'));

// Resource route + named routes otomatis
Route::resource('posts', PostController::class);