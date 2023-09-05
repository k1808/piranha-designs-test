<?php

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'destroy']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/all-staff', [\App\Http\Controllers\Api\AdminOperationController::class, 'allStaff']);
    Route::get('/edit-staff/{id}', [\App\Http\Controllers\Api\AdminOperationController::class, 'editStaff']);
    Route::get('/dashboard-staff', [\App\Http\Controllers\Api\StaffController::class, 'dashboardStaff']);
    Route::get('/show-staff/{id}', [\App\Http\Controllers\Api\StaffController::class, 'showStaff']);
    Route::get('/free-policies/{user}', [\App\Http\Controllers\Api\AdminOperationController::class, 'freePolicy']);
    Route::post('/add-policy-for-user', [\App\Http\Controllers\Api\AdminOperationController::class, 'addPolicyForUser']);
    Route::post('/remove-policy-for-user', [\App\Http\Controllers\Api\AdminOperationController::class, 'removePolicyForUser']);
    Route::post('/remove-all-policy-for-user', [\App\Http\Controllers\Api\AdminOperationController::class, 'removeAllPolicyForUser']);
    Route::post('/change-login', [\App\Http\Controllers\Api\AdminOperationController::class, 'changeLogin']);
});
