<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CountryController;
use App\Http\Controllers\Api\v1\TestimonyController;

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

Route::get('/', function () {
    return 'This is API version 1.0';
});


/**
 * Non autheticated routes
 */
 Route::get('/testimonies', [TestimonyController::class, 'index']);
 Route::get('/categories', [CategoryController::class, 'index']);
 Route::get('/countries', [CountryController::class, 'index']);
 Route::post('/register', [AuthController::class, 'register'])->name('register');
 Route::post('/login', [AuthController::class,'login'])->name('login');



  Route::middleware(['auth:api'])->group(function () {
      Route::get('auth', [AuthController::class, 'auth']);
  });
