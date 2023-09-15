<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('/employee')->group(function () {
    Route::post('/', [EmployeeController::class, 'load_db']);
    Route::get('/', [EmployeeController::class, 'get_all_employee']);
    Route::get('/{id}', [EmployeeController::class, 'get_employee']);
    Route::delete('/{id}', [EmployeeController::class, 'del_employee']);
});