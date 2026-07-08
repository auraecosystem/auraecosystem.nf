<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| These routes handle all browser requests for the Web4 platform.
|
*/

Route::get('/', function () {
    return view('home', [
        'app' => [
            'name' => config('app.name', 'Web4'),
            'version' => config('app.version', '1.0.0'),
            'environment' => app()->environment(),
            'php' => PHP_VERSION,
            'laravel' => app()->version(),
        ],
    ]);
})->name('home');


Route::view('/about', 'about')
    ->name('about');

Route::view('/docs', 'docs')
    ->name('docs');

Route::view('/marketplace', 'marketplace')
    ->name('marketplace');

Route::view('/ai', 'ai')
    ->name('ai');

Route::view('/blockchain', 'blockchain')
    ->name('blockchain');

Route::view('/dashboard', 'dashboard')
    ->name('dashboard');

Route::fallback(function () {
    abort(404);
});
