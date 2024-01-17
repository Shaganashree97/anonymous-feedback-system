<?php

use App\Http\Controllers\FeedbackController;

Route::prefix('feedbacks')->group(function () {
    Route::get('/', [FeedbackController::class, 'index'])->name('api.feedback.index');
    Route::post('/', [FeedbackController::class, 'store'])->name('api.feedback.store');
});
