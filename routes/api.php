<?php
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/customers', [CustomersController::class, 'index']);
Route::get('/customers/{$id}', [CustomersController::class, 'show']);

// Protected routes

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/customers', [CustomersController::class, 'store']);
    Route::put('/customers/{$id}', [CustomersController::class, 'update']);
    Route::delete('/customers/{$id}', [CustomersController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
    

});
