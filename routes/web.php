<?php

use App\Http\Controllers\AuthController;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PackageController;
use \App\Http\Controllers\SubscriptionController;
use \App\Http\Controllers\PaymentController;
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

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::prefix('page')->group(function(){
	Route::view('/help-center', 'pages.help-center')->name('help-center');
	Route::view('/change-password', 'pages.change-password')->name('pages.change-password');
});

Route::prefix('subs')->group(function(){
	Route::get('/', [SubscriptionController::class, 'index'])->name('subscriptions');
    Route::get('/manage', [SubscriptionController::class, 'create'])->name('subs.manage');
    Route::view('/delete', 'subs.destroy')->name('subs.delete');
    Route::post('/create', [SubscriptionController::class, 'store'])->name('subs.create');
	Route::view('/payments', 'subs.payments')->name('subs.payments');
});

Route::prefix('jobs')->group(function(){
	Route::get('/', [JobController::class, 'index'])->name('jobs');
	Route::view('/favorite', 'job.favorite')->name('jobs.favorite');
	Route::view('/history', 'job.history')->name('jobs.history');
    Route::get('/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/apply', [JobController::class, 'apply'])->name('jobs.apply');
    Route::post('/create', [JobController::class, 'store'])->name('job.create');
    Route::post('/delete', [JobController::class, 'destroy'])->name('job.delete');
});

Route::prefix('packages')->group(function(){
    Route::get('/', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('/apply', [PackageController::class, 'apply'])->name('packages.apply');
    Route::post('/create', [PackageController::class, 'store'])->name('packages.create');
    Route::post('/delete', [PackageController::class, 'destroy'])->name('packages.delete');
    Route::get('/applications', [PackageController::class,'applications'])->name('packages.applications');
    Route::post('/update', [PackageController::class,'update_package_status'])->name('packages.update');
    Route::post('/upload', [PackageController::class,'upload_document'])->name('packages.upload');
    Route::get('/review', [PackageController::class,'review'])->name('packages.review');
});

Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('paystack.pay');
Route::get('/handle-payment', [PaymentController::class, 'handleGatewayCallback'])->name('paystack.callback');
