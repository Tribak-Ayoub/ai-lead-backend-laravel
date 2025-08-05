<?php

use App\Http\Controllers\Api\AiController;
use App\Http\Controllers\Api\CallSessionController;
use App\Http\Controllers\Api\LeadController;
use Illuminate\Support\Facades\Route;

Route::apiResource('leads', LeadController::class);
Route::apiResource('call-sessions', CallSessionController::class);

Route::post('/ai/ask', [AiController::class, 'ask']);