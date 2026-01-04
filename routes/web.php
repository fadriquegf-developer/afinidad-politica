<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegalController;

Route::get('/', [TestController::class, 'index'])->name('test.index');
Route::post('/start', [TestController::class, 'start'])->name('test.start');
Route::get('/question/{number}', [TestController::class, 'question'])->name('test.question');
Route::post('/question/{number}', [TestController::class, 'answer'])->name('test.answer');
Route::get('/results', [TestController::class, 'results'])->name('test.results');
Route::post('/restart', [TestController::class, 'restart'])->name('test.restart');

// URL compartible de resultados (pública)
Route::get('/r/{shareId}', [TestController::class, 'shared'])->name('test.shared');

// Comparador de resultados
Route::get('/comparar/{shareId1}/{shareId2?}', [TestController::class, 'compare'])->name('test.compare');

// Páginas legales
Route::get('/privacidad', [LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/aviso-legal', [LegalController::class, 'notice'])->name('legal.notice');
Route::get('/cookies', [LegalController::class, 'cookies'])->name('legal.cookies');
Route::get('/metodologia', [LegalController::class, 'methodology'])->name('legal.methodology');
Route::get('/sobre-nosotros', [LegalController::class, 'about'])->name('legal.about');

// Cambio de idioma
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['es', 'ca', 'eu', 'gl'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');
