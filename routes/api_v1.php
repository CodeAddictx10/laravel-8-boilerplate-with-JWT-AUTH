<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\CountryController;
use App\Http\Controllers\API\V1\HireController;
use App\Http\Controllers\API\V1\TestimonyController;

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
 Route::get('/countries', [CountryController::class, 'index']);
 Route::group(["prefix"=>'categories'], function () {
     Route::get('', [CategoryController::class, 'index']);
     Route::get('{categoryId}/skills', [CategoryController::class, 'show']);
 });

 Route::post('/register', [AuthController::class, 'register'])->name('register');
 Route::post('/login', [AuthController::class,'login'])->name('login');

 Route::post('talents/search', [HireController::class, 'filterTalents'])->name('get-talent');

  Route::middleware(['auth:api'])->group(function () {
      Route::get('auth', [AuthController::class, 'auth']);
      Route::post('hires', [HireController::class, 'store']);
  });
