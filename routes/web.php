<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear', function() {
    $cache = Artisan::call('cache:clear');
    $view = Artisan::call('view:clear');
    $route = Artisan::call('route:clear');
    $config = Artisan::call('config:clear');

    dump(' cache = '.$cache);
    dump(' route = '.$route);
    dump(' config = '.$config);
    dd(' view = '.$view);
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Auth::routes();


Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard');