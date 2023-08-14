<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ExcelReport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('cars', CarController::class);
Route::group(['prefix' => 'all_cars'], function(){
    Route::get('all', [CarController::class, 'getAllCars']);
});
Route::group(['prefix' => 'reports'], function(){
    Route::get('generate-cars-excel', [ExcelReport::class, 'generateCarsExcel']);
});
