<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BaloshController extends Controller
{
    //

    private  $details;
    public function verifyAccess()
    {

        $body = json_decode(request()->getContent(),true);
        \request()->request->add(['code'=>$body['accessCode']]);
//        \request()->request->add(['code'=>11111]);
        try{
        $response=$this->accessTungstile();
        if($response['status']=='success') {
            return response()->json([
                "accessGranted"=> true,
                "message"=> "Access authorized for entry"
            ]);
        }

        }catch (\Exception $e){

        }

        return response()->json([
            "accessGranted"=> false,
            "message"=> "Invalid or expired code"
        ]);


    }


    public function accessTungstile(){
        if(\request()->method()=='POST'){
            $myArray = json_decode(request()->getContent(), TRUE);
            if ($myArray == '') {
                throw new \Exception('Invalid Json Data');
            }
            \request()->request->add($myArray);
        }

        $code=request()->code;

        $this->details = QrCode::with(['registration', 'attendance'])
            //->whereNull('date_used')
            ->where('token', ($code))->first();
//        if (request()->token != '56TYbbbyuebujefn9902b') {
//            return response()->json(['status' => 'error', 'message' => 'Invalid Authn Code , No entry'], 404);
//        }

        if (is_null($this->details)) {
            return (['status' => 'error', 'message' => 'Invalid QR Code , No entry']);
        }

        Attendance::updateOrCreate(['registration_id' => $this->details->registration->id], [
            'registration_id' => $this->details->registration->id,
            'date_admitted' => now()
        ]);

        $this->details->update([
            'date_used' => now()->format('Y-m-d')
        ]);


        return (['status' => 'success', 'message' => 'Permission Granted']);

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
