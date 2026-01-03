<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    // Dashboard de estadísticas personalizado
    Route::get('dashboard', 'DashboardController@index')->name('backpack.dashboard');
    Route::get('api/stats', 'DashboardController@apiStats')->name('backpack.api.stats');

    // CRUD routes
    Route::crud('party', 'PartyCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('question', 'QuestionCrudController');
    Route::crud('party-position', 'PartyPositionCrudController');
    Route::crud('test-result', 'TestResultCrudController');
    Route::crud('test-answer', 'TestAnswerCrudController');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
