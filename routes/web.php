<?php

use App\Http\Controllers\Admin\AiIntentController;
use App\Http\Controllers\Admin\PlanAndPricingController as AdminPlanAndPricingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\BillingAndPlanController;
use App\Http\Controllers\Client\BillingAndPlanController as ClientBillingAndPlanController;
use App\Http\Controllers\Client\CallLogController;

use App\Http\Controllers\Client\ClientDashboardController;

use App\Http\Controllers\Admin\AiSettingsController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\PlanAndPricingController;
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('admin/intents')->controller(AiIntentController::class)->group(function () {
    Route::get('/', 'index')->name('intents.index');
    Route::post('/', 'store')->name('intents.store');
    Route::put('/{intent}', 'update')->name('intents.update');
    Route::delete('/{intent}', 'destroy')->name('intents.destroy');
    Route::post('/{intentId}/utterance', 'addUtterance')->name('intents.utterance.add');
    Route::delete('/utterance/{id}', 'removeUtterance')->name('intents.utterance.remove');
    Route::post('/retrain', 'retrain')->name('intents.retrain');
});


Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


Route::middleware('auth:sanctum')->get('/client/stats', [ClientDashboardController::class, 'stats']);



Route::prefix('admin')->group(function () {
    Route::get('ai-settings', [AiSettingsController::class, 'getSettings']);
    Route::put('ai-settings', [AiSettingsController::class, 'updateSettings']);
    Route::post('ai-settings/rotate-key', [AiSettingsController::class, 'rotateGptKey']); // لتدوير المفتاح
});



Route::prefix('admin/plans')->group(function () {
    Route::get('/', [AdminPlanAndPricingController::class, 'index'])->name('plans.index');
    Route::post('/', [AdminPlanAndPricingController::class, 'store'])->name('plans.store');
    Route::put('/{plan}', [AdminPlanAndPricingController::class, 'update'])->name('plans.update');
    Route::delete('/{plan}', [AdminPlanAndPricingController::class, 'destroy'])->name('plans.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::resource('calllogs', CallLogController::class);
});


Route::middleware('auth')->prefix('billing')->group(function () {
    Route::get('/plan', [ClientBillingAndPlanController::class, 'index'])->name('billing.plan');
    Route::post('/upgrade', [ClientBillingAndPlanController::class, 'upgrade'])->name('billing.upgrade');
    Route::post('/cancel', [ClientBillingAndPlanController::class, 'cancel'])->name('billing.cancel');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
