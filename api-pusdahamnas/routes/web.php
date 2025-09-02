<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Mail\VerifRegistration;
use Illuminate\Support\Facades\Mail;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/email', function () {
	$randomNumber = '';
	for ($i = 0; $i < 6; $i++) {
		$randomNumber .= strval(random_int(0, 9)); // Menghasilkan angka acak antara 0 dan 9, lalu mengubahnya menjadi string
	}


	echo $randomNumber;
});


Route::get('/phpinfo', function () {
	phpinfo();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
