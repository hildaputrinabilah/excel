<?php
use App\Http\Controllers\DataController;
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


Route::post('/insert-data', [DataController::class, 'store']);
Route::post('/filter-data', [DataController::class, 'filterData']);
Route::put('/update-data/{id}', [DataController::class, 'update']);
Route::get('/data/{id}', [DataController::class, 'show']);
Route::get('/data', [DataController::class, 'index']);
Route::delete('/delete-data/{id}', [DataController::class, 'destroy']);
