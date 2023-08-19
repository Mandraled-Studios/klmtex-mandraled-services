<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/choices/categories', [APIController::class, 'loadCategoryOptions']);
Route::get('/products/choices/subcategories', [APIController::class, 'loadSubcategoryOptions']);
Route::get('/products/choices/subcategories/{cat}', [APIController::class, 'loadSubcategoryOptionsUnder']);
Route::get('/products/choices/secondary-subcategories', [APIController::class, 'loadSecondarySubcategoryOptions']);
Route::get('/products/choices/secondary-subcategories/{subcat}', [APIController::class, 'loadSecondarySubcategoryOptionsUnder']);
