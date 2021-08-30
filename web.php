<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\securityappcontroller;

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
    return view('index');
});

Route::get('/candidateapply', function () {
    return view('candidateapply');
});

Route::get('/paymenttest', function () {
    return view('paymenttest');
});

Route::get('/paymentresponse', function () {
    return view('paymentresponse');
});

Route::get('/currenttenders', function () {
    return view('currenttenders');
});


Route::any('/securityapplicationform', 'App\Http\Controllers\PayuMoneyController@redirectToPayU')->name('redirectToPayU');
Route::get('/securityapplicationform', function () {
    return view('securityapplicationform');
});

Route::post('securityapplicationform', [securityappcontroller::class, 'savedata']);


Route::get('/test', function () {
    return view('testing');
});

Route::post('testing', [TestController::class, 'savedata']);


Route::get('/tenderapply', function () {
    return view('tenderapply');
});

Route::get('/thecompany', function () {
    return view('thecompany');
});

Route::get('/boardofdirectors', function () {
    return view('boardofdirectors');
});

Route::get('/organizationstructure', function () {
    return view('organizationstructure');
});

Route::get('/ourpresence', function () {
    return view('ourpresence');
});

Route::get('/newsandupdates', function () {
    return view('newsandupdates');
});

Route::get('/ourethics', function () {
    return view('ourethics');
});

Route::get('/csr', function () {
    return view('csr');
});

Route::get('/cng', function () {
    return view('cng');
});

Route::post('/evcharging', function () {
    return view('evcharging');
});
Route::get('/evcharging', function () {
    return view('evcharging');
});

Route::get('/lpgdomestic', function () {
    return view('lpgdomestic');
});

Route::get('/lpgcommericial', function () {
    return view('lpgcommercial');
});

Route::get('/lpgindustrial', function () {
    return view('lpgindustrial');
});


Route::get('/investorsinformation', function () {
    return view('investorsinformation');
});


Route::get('/newspapernotices', function () {
    return view('newspapernotices');
});

Route::get('/investorsnotices', function () {
    return view('investorsnotices');
});

Route::get('/workculture', function () {
    return view('workculture');
});

Route::get('/currentopenings', function () {
    return view('currentopenings');
});

Route::get('/currentopenings', function () {
    return view('currentopenings');
});

Route::get('/currenttenders', function () {
    return view('currenttenders');
});

Route::get('/knowledgecenter', function () {
    return view('knowledgecenter');
});

Route::get('/downloads', function () {
    return view('downloads');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/disclaimer', function () {
    return view('disclaimer');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/about', function () {
    return view('thecompany');
});

Route::get('/sitemap', function () {
    return view('sitemap');
});
Route::get('/tenderprocedures', function () {
    return view('tenderprocedures');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
