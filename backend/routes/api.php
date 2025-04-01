<?php

use App\Http\Controllers\TrappingRainWaterController;
use Illuminate\Support\Facades\Route;

Route::prefix('calculate')->group((function () {
    Route::get('from-file', [TrappingRainWaterController::class, 'calculateFromFile']);
    Route::get('from-single-list', [TrappingRainWaterController::class, 'calculateFromSingleList']);
}));
