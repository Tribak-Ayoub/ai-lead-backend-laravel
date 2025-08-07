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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanAndPricingController;
use App\Http\Controllers\Client\CampaignController;
use App\Http\Controllers\ManagementController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/checkout-paiment', [HomeController::class, 'checkoutPaiment'])->name('checkoutPaiment');

Route::prefix('Admin/ai-intents')->controller(AiIntentController::class)->group(function () {
    Route::get('/', 'index')->name('intents.index');
    Route::post('/', 'store')->name('intents.store');
    Route::put('/{intent}', 'update')->name('intents.update');
    Route::delete('/{intent}', 'destroy')->name('intents.destroy');
    Route::post('/{intentId}/utterance', 'addUtterance')->name('intents.utterance.add');
    Route::delete('/utterance/{id}', 'removeUtterance')->name('intents.utterance.remove');
    Route::post('/retrain', 'retrain')->name('intents.retrain');
});


Route::get('/Admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


Route::get('/Admin/ClientManagment', [ManagementController::class, 'index'])->name('admin.ClientManagment');

Route::get('/Client/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');

Route::get('/Client/billing-plan', [ClientBillingAndPlanController::class, 'index'])->name('client.dashboard');

Route::middleware('auth:sanctum')->get('/client/stats', [ClientDashboardController::class, 'stats']);



Route::prefix('admin')->group(function () {
    Route::get('ai-settings', [AiSettingsController::class, 'getSettings']);
    Route::put('ai-settings', [AiSettingsController::class, 'updateSettings']);
    Route::post('ai-settings/rotate-key', [AiSettingsController::class, 'rotateGptKey']); // لتدوير المفتاح
});



Route::prefix('Admin/plans')->group(function () {
    Route::get('/', [AdminPlanAndPricingController::class, 'index'])->name('plans.index');
    Route::post('/', [AdminPlanAndPricingController::class, 'store'])->name('plans.store');
    Route::put('/{plan}', [AdminPlanAndPricingController::class, 'update'])->name('plans.update');
    Route::delete('/{plan}', [AdminPlanAndPricingController::class, 'destroy'])->name('plans.destroy');
});



// Route::middleware(['auth'])->group(function () {
//     Route::resource('calllogs', CallLogController::class);
// });

Route::get('/Client/call-logs', [CallLogController::class, 'index'])->name('client.call-logs');


Route::middleware('auth')->prefix('billing')->group(function () {
    Route::get('/plan', [ClientBillingAndPlanController::class, 'index'])->name('billing.plan');
    Route::post('/upgrade', [ClientBillingAndPlanController::class, 'upgrade'])->name('billing.upgrade');
    Route::post('/cancel', [ClientBillingAndPlanController::class, 'cancel'])->name('billing.cancel');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
Route::put('/campaigns/{id}', [CampaignController::class, 'update'])->name('campaigns.update');
Route::delete('/campaigns/{id}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');

// require __DIR__.'/auth.php';
