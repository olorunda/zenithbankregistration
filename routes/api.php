<?php

use App\Models\Attendance;
use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/verify_qr', function () {

    $myArray = json_decode(request()->getContent(), TRUE);
    if ($myArray == '') {
        throw new \Exception('Invalid Json Data');
    }
    \request()->request->add($myArray);
    $code=request()->code;
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
