<?php

use App\Http\Controllers\RelationshipController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Eloquent Relationships Demo
|--------------------------------------------------------------------------
*/

Route::get('/', [RelationshipController::class, 'dashboard'])->name('dashboard');

// Relationship Demonstration Routes matching the dashboard cards
Route::get('/students', [RelationshipController::class, 'students'])->name('relationships.students');
Route::get('/one-to-one', [RelationshipController::class, 'oneToOne'])->name('relationships.one-to-one');
Route::get('/one-to-many', [RelationshipController::class, 'oneToMany'])->name('relationships.one-to-many');
Route::get('/many-to-many', [RelationshipController::class, 'manyToMany'])->name('relationships.many-to-many');
Route::get('/has-one-through', [RelationshipController::class, 'hasOneThrough'])->name('relationships.has-one-through');
Route::get('/has-many-through', [RelationshipController::class, 'hasManyThrough'])->name('relationships.has-many-through');
Route::get('/has-one-of-many', [RelationshipController::class, 'hasOneOfMany'])->name('relationships.has-one-of-many');
