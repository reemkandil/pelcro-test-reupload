<?php

use App\Http\Controllers\customerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\customer;

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

// Common Resource Routes:
// index - Show all customers
// show - Show single customer
// create - Show form to create new customer
// store - Store new customer
// edit - Show form to edit customer
// update - Update customer
// destroy - Delete customer  

// All customers
Route::get('/', [customerController::class, 'index']);

// Show Create Form
Route::get('/customers/create', [customerController::class, 'create'])->middleware('auth');

// Store customer Data
Route::post('/customers', [customerController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/customers/{customer}/edit', [customerController::class, 'edit'])->middleware('auth');

// Update customer
Route::put('/customers/{customer}', [customerController::class, 'update'])->middleware('auth');

// Delete customer
Route::delete('/customers/{customer}', [customerController::class, 'destroy'])->middleware('auth');

// Manage customers
Route::get('/customers/manage', [customerController::class, 'manage'])->middleware('auth');

// Single customer
Route::get('/customers/{customer}', [customerController::class, 'show']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);