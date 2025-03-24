<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index'])
    ->name('book.list');
Route::get('/search/{query?}', [BookController::class, 'index'])
    ->where('query', '.*')
    ->name('book.search.list');
Route::get('/{book}', [BookController::class, 'getById'])
    ->where('book', '[0-9]+')
    ->name('book.index');
Route::get('/edit/{book}', [BookController::class, 'edit'])
    ->name('book.edit');
Route::get('/new', [BookController::class, 'create'])
    ->name('book.new');


Route::post('/save', [BookController::class, 'save'])
    ->name('book.save');
Route::post('/save/{book}', [BookController::class, 'update'])
    ->name('book.update');
Route::delete('/delete/{book}', [BookController::class, 'delete']);
