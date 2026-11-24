<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CaseImageController;
use App\Http\Controllers\Api\V1\LeadController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\SiteContentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{slug}', [ServiceController::class, 'show']);
    Route::get('/content/{sectionKey}', [SiteContentController::class, 'show']);
    Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:10,1');

    Route::post('/auth/login', [AuthController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::put('/admin/password', [AuthController::class, 'changePassword']);

        Route::get('/admin/leads', [LeadController::class, 'index']);
        Route::get('/admin/leads/export', [LeadController::class, 'exportCsv']);
        Route::patch('/admin/leads/{lead}', [LeadController::class, 'updateStatus']);

        Route::post('/admin/services/{service}/cases', [CaseImageController::class, 'store']);
        Route::patch('/admin/cases/{caseImage}', [CaseImageController::class, 'update']);
        Route::delete('/admin/cases/{caseImage}', [CaseImageController::class, 'destroy']);

        Route::put('/admin/content/{sectionKey}', [SiteContentController::class, 'update']);
    });
});
