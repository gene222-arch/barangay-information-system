<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\ResidentsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'middleware' => 'auth'
], function () {
    Route::resource('notes', NotesController::class);
    Route::resource('residents', ResidentsController::class);
});