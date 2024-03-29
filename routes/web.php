<?php

use App\Http\Controllers\AssistanceRequestController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExportsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResidentsController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\UserComplaintsController;
use App\Models\Document;
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
    Route::resource('assistance-requests', AssistanceRequestController::class);
    Route::get('/city-directory', fn () => view('pages.city-directory'));
    Route::resource('schedules', SchedulesController::class);
    Route::resource('notes', NotesController::class);

    Route::middleware('role:Administrator|Supervisor')->group(function () 
    {
        Route::group([
            'prefix' => 'documents',
            'as' => 'documents.'
        ], function () {
            Route::get('/', [DocumentController::class, 'index'])->name('index');
            Route::get('/monthly-revenues', [DocumentController::class, 'monthlyRevenues'])
                ->name('monthly-revenues')
                ->middleware('role:Administrator');
            Route::put('/pay/{document}', [DocumentController::class, 'pay'])->name('pay');
        });

        Route::get('/non-residents/create', [ResidentsController::class, 'create'])
            ->name('residents.none.create');
        Route::get('/non-residents/{resident}', [ResidentsController::class, 'edit'])
            ->name('residents.none.edit');
        Route::resource('residents', ResidentsController::class);
        Route::post('/residents/view-by-barcode', [ResidentsController::class, 'showViaBarcode'])
            ->name('residents.barcode');
        
        Route::resource('user-complaints', UserComplaintsController::class);
        Route::put('/user-complaints/{complaint}/clear', [UserComplaintsController::class, 'clear'])->name('user-complaints.clear');
    
        Route::prefix('exports')->group(function ()
        {
            Route::name('export.')->group(function ()
            {
                Route::get('/barangay-clearance/{resident}', [ExportsController::class, 'barangayClearance'])->name('barangay-clearance');
                Route::get('/barangay-certification/{resident}', [ExportsController::class, 'barangayCertification'])->name('barangay-certification');
                Route::get('/certificate-of-indigency/{resident}', [ExportsController::class, 'certificateOfIndigency'])->name('cert.of.indegency');
                Route::get('/certificate-of-registration/{resident}', [ExportsController::class, 'certificateOfRegistration'])->name('cert.of.registration');
                Route::get('/id/{resident}', [ExportsController::class, 'id'])->name('id');
                Route::get('/court-reservation', [ExportsController::class, 'courtReservation'])->name('court.reservation');
                Route::get('/schedules', [ExportsController::class, 'schedules'])->name('schedules');
            });
        });
    });
});