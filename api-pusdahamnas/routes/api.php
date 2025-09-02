<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiKeyController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\SetPasswordController;//andiek
use App\Http\Controllers\API\Dokumen\DokumenController;
use App\Http\Controllers\API\LembagaHAM\LembagaHAMController;
use App\Http\Controllers\API\AhliHAM\AhliHAMController;
use App\Http\Controllers\API\Glosarium\GlosariumController;
use App\Http\Controllers\API\Infografis\InfografisController;
use App\Http\Controllers\API\Auth\UserController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great! 
|
*/

Route::middleware(['chekapikey'])->group(function () {
    Route::prefix('dokumen')->group(function () {
        Route::post('/all', [DokumenController::class, 'index'])->name('dokumen.getall');
        Route::post('/getbytotal', [DokumenController::class, 'getByCountPage'])->name('dokumen.getbytotal');
        Route::get('/detail/{id}', [DokumenController::class, 'detail'])->name('dokumen.detail');
    });

    Route::prefix('infografis')->group(function () {
        Route::post('/all', [InfografisController::class, 'index'])->name('infografis.index');
        Route::get('/detail/{id}', [InfografisController::class, 'detail'])->name('infografis.detail');
    });

    Route::prefix('lembaga-ham')->group(function () {
        Route::post('/all', [LembagaHAMController::class, 'index'])->name('lembagaham.getall');
        Route::post('/getbytotal', [LembagaHAMController::class, 'getByCountPage'])->name('lembagaham.getbytotal');
    });

    Route::prefix('glosarium')->group(function () {
        Route::post('/all', [GlosariumController::class, 'index'])->name('glosarium.getall');
        Route::post('/getbytotal', [GlosariumController::class, 'getByCountPage'])->name('glosarium.getbytotal');
    });

    Route::prefix('ahliham')->group(function () {
        Route::post('/all', [AhliHAMController::class, 'index'])->name('ahliham.getall');
    });
});

Route::prefix('apikey')->group(function () {
    Route::get('/', [ApiKeyController::class, 'index']);
    Route::post('/store', [ApiKeyController::class, 'store'])->name('apikey.store');
    Route::post('/approve', [ApiKeyController::class, 'approve'])->name('apikey.approve');
    Route::post('/delete/{id}', [ApiKeyController::class, 'destroy'])->name('apikey.delete');
});

Route::prefix('auth')->group(function () {
    Route::middleware('chekapikey')->group(function () {
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/sendemail', [RegisterController::class, 'sendemail'])->name('sendemail');
        Route::post('/sendemailpassword', [SetPasswordController::class, 'sendemailpassword'])->name('sendemailpassword');//andiek
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::post('/verification-register', [RegisterController::class, 'verif'])->name('verif');
        Route::post('/dokumen/download', [DokumenController::class, 'downloadDokumen'])->name('dokumen.download');
        Route::post('/approve-pegiatham', [RegisterController::class, 'approve'])->name('approve');
        Route::middleware(['jwt.verify'])->group(function () {
            Route::post('/profile', [UserController::class, 'profile'])->name('profile');
            Route::post('/update-foto', [UserController::class, 'updateFoto'])->name('update-foto');
            Route::post('/refresh', [UserController::class, 'refresh'])->name('refresh');
            Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        });
        // Ellis
        Route::post('/resendOtp', [RegisterController::class, 'resendOtp'])->name('resendOtp');
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
