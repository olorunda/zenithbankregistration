<?php

use App\Models\Attendance;
use App\Models\QrCode;
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
Route::get('/', function () {
    return to_route('registration');
})->name('welcome');

Route::get('/qr_image/{code}', function ($code) {
    return response()->file(storage_path("app/public/qrcode/$code"));

});


Route::get('/verify_qr/{code}', function ($code) {

    $this->details = QrCode::with(['registration', 'attendance'])->where('token', cleaner($code))->first();
    if (request()->token != '56TYbbbyuebujefn9902b') {
        return response()->json(['status' => 'error', 'message' => 'Invalid Authn Code , No entry'], 404);

    }
    if (is_null($this->details)) {
        return response()->json(['status' => 'error', 'message' => 'Invalid QR Code , No entry'], 404);
    }
    Attendance::updateOrCreate(['registration_id' => $this->details->registration->id], [
        'registration_id' => $this->details->registration->id,
        'date_admitted' => now()
    ]);

    return response()->json(['status' => 'success', 'message' => 'Permission Granted']);


});

Route::group(['namespace' => '\App\Http\Livewire'], function () {

    Route::get('/registration', \Users\Index::class)->name('registration');

    Route::group(['prefix' => 'portal/admin', 'as' => 'portal.'], function () {

        Route::get('/', \Portal\Login::class)->name('admin-login');

        Route::get('/login', \Portal\Login::class)->name('login');

        Route::group(['middleware' => 'auth'], function () {

            Route::get('/dashboard', \Portal\Dashboard::class)->name('dashboard');

            Route::get('/registration/view/{token}', \Portal\ViewDetails::class)->name('view-registration');

            Route::get('/attendances', \Portal\Attendances::class)->name('attendances');

        });

        Route::get('/logout', function () {
            Auth::logout();
            return redirect()->to(route('portal.login'));
        })->name('logout');

    });

});
