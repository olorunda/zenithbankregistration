<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BaloshController extends Controller
{
    //

    public function verifyAccess()
    {
        $body = json_decode(request()->getContent(),true);
        $response=Http::get(url('api/verify_qr').'?token=56TYbbbyuebujefn9902b&code='.$body['accessCode'])->json();//->toArray();

        if($response['status']=='success') {
            return response()->json([
                "accessGranted"=> true,
                "message"=> "Access authorized for entry"
            ]);
        }
            return response()->json([
                "accessGranted"=> false,
                "message"=> "Invalid or expired code"
            ]);

    }

    public function accessNotify()
    {
        $body = request()->getContent();
        Log::info(json_encode($body));
        return response()->json([
            "received"=> true,
            "message"=> "Access event logged successfully"
        ]);
    }
}
