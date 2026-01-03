<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestController::class, 'index'])->name('test.index');
Route::post('/start', [TestController::class, 'start'])->name('test.start');
Route::get('/question/{number}', [TestController::class, 'question'])->name('test.question');
Route::post('/question/{number}', [TestController::class, 'answer'])->name('test.answer');
Route::get('/results', [TestController::class, 'results'])->name('test.results');
Route::post('/restart', [TestController::class, 'restart'])->name('test.restart');

// URL compartible de resultados (pública)
Route::get('/r/{shareId}', [TestController::class, 'shared'])->name('test.shared');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['es', 'ca', 'eu', 'gl'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');
