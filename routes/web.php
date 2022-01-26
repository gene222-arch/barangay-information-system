<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\ResidentsController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\UserComplaintsController;
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

Route::get('/home-page', function () {
    return view('pages.home');
})->name('home');

Auth::routes();

Route::group([
    'middleware' => 'auth'
], function () {
    Route::resource('notes', NotesController::class);
    Route::resource('residents', ResidentsController::class);
    Route::resource('schedules', SchedulesController::class);
    Route::resource('user-complaints', UserComplaintsController::class);

    Route::put('/user-complaints/{complaint}/clear', [UserComplaintsController::class, 'clear'])->name('user-complaints.clear');
});