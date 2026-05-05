<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\HomeownerController;
use App\Http\Controllers\Api\OfficerController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StickerController;
use App\Http\Controllers\Api\AdminStickerController;
use App\Http\Controllers\Api\GuardController;
use App\Http\Controllers\Api\MonthlyDueController;
use App\Http\Controllers\Api\PaymentController;

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


Route::post('/contact', [ContactController::class, 'store']);
Route::get('projects', [ProjectController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::get('contact-messages', [ContactController::class, 'index']);
        Route::post('contact-messages/{id}/read', [ContactController::class, 'markAsRead']);
        Route::delete('contact-messages/{id}', [ContactController::class, 'destroy']);

        Route::get('users', [UserController::class, 'index']);
        Route::post('users', [UserController::class, 'store']);
        Route::put('users/{id}', [UserController::class, 'update']);
        Route::delete('users/{id}', [UserController::class, 'destroy']);
        Route::post('users/{id}/change-password', [UserController::class, 'changePassword']);

        // Projects
        Route::get('projects', [ProjectController::class, 'index']);
        Route::post('projects', [ProjectController::class, 'store']);
        Route::post('projects/{id}', [ProjectController::class, 'update']);
        Route::delete('projects/{id}', [ProjectController::class, 'destroy']);

        // Route::post('/save-landing', [SettingsController::class, 'saveLanding']);
        // Route::post('/save-general-settings', [SettingsController::class, 'saveGeneralSettings']);
        // Route::post('/save-monthly-due', [SettingsController::class, 'saveMonthlyDue']);
        // Route::post('/run-dues', [SettingsController::class, 'runDues']);

        Route::get('/dashboard', [AdminController::class, 'dashboard']);
    });

});