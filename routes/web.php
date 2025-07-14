<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
Route::get('/image', function () {
    return response()->file(storage_path('app/public/'.request('path')));
})->name('image');



Route::group(['namespace' => '\App\Http\Livewire'], function() {

    Route::get('/registration', \Users\Index::class)->name('registration');

    Route::group(['prefix' => 'portal/admin', 'as' => 'portal.'], function() {

        Route::get('/', \Portal\Login::class)->name('admin-login');

        Route::get('/login', \Portal\Login::class)->name('login');

        Route::group(['middleware' => 'auth'], function() {

            Route::get('/dashboard', \Portal\Dashboard::class)->name('dashboard');

            Route::get('/registration/view/{token}', \Portal\ViewDetails::class)->name('view-registration');

            Route::get('/attendances', \Portal\Attendances::class)->name('attendances');

        });

        Route::get('/logout', function() {
            Auth::logout();
            return redirect()->to(route('portal.login'));
        })->name('logout');

    });

});
