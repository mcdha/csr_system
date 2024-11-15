<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\OptionValueController;

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

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// ? Auth start
Route::middleware(['guest'])->group(function () {
    Route::resource('login', AuthController::class)->only(['index']);
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('otp_verification/{uuid}', [OtpVerificationController::class, 'index'])->name('otp_verification.index');
    Route::post('otp_verification', [OtpVerificationController::class, 'verify'])->name('otp_verification.verify');

    Route::post('password_reset/save_new_password', [PasswordResetController::class, 'saveNewPassword'])->name('password_reset.save_new_password');
    Route::get('password_reset/{uuid}', [PasswordResetController::class, 'index'])->name('password_reset.index');
    Route::resource('password_reset', PasswordResetController::class)->only(['store']);
    Route::put('password_reset/{uuid}/resend', [PasswordResetController::class, 'resend'])->name('password_reset.resend');
});
// ? Auth end

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('dashboard', DashboardController::class)->only(['index']);
    Route::get('/dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');

    Route::resource('users', UserController::class)->only(['index', 'create', 'edit', 'store', 'destroy', 'update']);

    Route::get('/queries/upload', [QueryController::class, 'upload'])->name('queries.upload');
    Route::post('/queries/import', [QueryController::class, 'import'])->name('queries.import');
    Route::post('/queries/export', [QueryController::class, 'export'])->name('queries.export');
    Route::get('/queries/filter', [QueryController::class, 'filter'])->name('queries.filter');
    Route::get('/queries/import-failures', [QueryController::class, 'importFailures'])->name('queries.importFailures');
    Route::resource('queries', QueryController::class)->only(['index', 'create', 'show', 'edit', 'store', 'update', 'destroy']);
    Route::put('queries/{query}/update-field', [QueryController::class, 'updateField'])->name('queries.updateField');

    Route::get('option-values/{field}', [OptionValueController::class, 'index'])->name('option-values.index');
    Route::resource('option-values', OptionValueController::class)->only(['update']);
});
