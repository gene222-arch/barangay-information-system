<?php

use App\Http\Controllers\ExportsController;
use App\Http\Controllers\HomeController;
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
], function () 
{
    Route::get('/', [HomeController::class, 'index']);
    Route::resource('notes', NotesController::class);
    Route::resource('residents', ResidentsController::class);
    
    Route::post('/residents/view-by-barcode', [ResidentsController::class, 'showViaBarcode'])->name('residents.barcode');

    Route::resource('schedules', SchedulesController::class);
    Route::resource('user-complaints', UserComplaintsController::class);

    Route::put('/user-complaints/{complaint}/clear', [UserComplaintsController::class, 'clear'])->name('user-complaints.clear');

    Route::get('/city-directory', fn () => view('pages.city-directory'));

    Route::prefix('exports')->group(function ()
    {
        Route::name('export.')->group(function ()
        {
            Route::get('/barangay-clearance/{resident}', [ExportsController::class, 'barangayClearance'])->name('barangay-clearance');
            Route::get('/certificate-of-indigency/{resident}', [ExportsController::class, 'certificateOfIndigency'])->name('cert.of.indegency');
        });
    });
});