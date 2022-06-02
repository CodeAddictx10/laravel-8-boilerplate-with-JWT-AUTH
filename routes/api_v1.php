<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\CountryController;
use App\Http\Controllers\API\V1\HireController;
use App\Http\Controllers\API\V1\SearchController;
use App\Http\Controllers\API\V1\TalentController;
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

 Route::post('talents/search', [SearchController::class, 'filterTalents'])->name('get-talent');

  Route::middleware(['auth:api'])->group(function () {
      Route::group(["prefix"=>'auth'], function () {
          Route::get('', [AuthController::class, 'auth']);
          Route::get('/userstats', [HireController::class, 'getUserStats']);
          Route::group(["prefix"=>'talents'], function () {
              Route::get('latest', [SearchController::class, 'filterTalentsByLatestSearch']);
              Route::get('search', [SearchController::class, 'filterTalentsBySkill'])->name("searchBySkill");
              Route::post('search', [SearchController::class, 'store']);
              Route::get('{talentId}', [TalentController::class, 'show']);
          });
          Route::group(["prefix"=>'showcases'], function () {
              Route::post('', [HireController::class, 'store']);
              Route::get('interviewed', [TalentController::class, 'getInterviewedTalent']);
              Route::get('hired', [TalentController::class, 'getHiredTalent']);
              Route::get('saved', [TalentController::class, 'getSavedTalent']);
          });
      });
  });
