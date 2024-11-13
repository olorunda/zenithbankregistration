<?php

namespace App\Console\Commands;

use App\Mail\GeneralNotificationMail;
use App\Models\QrCode;
use App\Models\Registration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class regenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regenerate:token {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate Token';
    private string $qr_code_url;
    private $fullname;
    private $email;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->argument('email')=='orhobo.ojonah@gmail.com'){
            $this->regenerateToken('orhobo.ojonah@gmail.com');
            return ;
        }
        Registration::orderBy('id')->chunk(1000,function($data){
           foreach ($data as $datum){
               $this->regenerateToken($datum->email);
           }
        });
//        $this->regenerateToken();
        return Command::SUCCESS;
    }



    private function regenerateToken($email=''){
        $token =$token_code= $this->verifyToken($this->generateRandomHex());
        $image = $base64image= generateQrCode($token);
        $registration=Registration::where('email',$email)->first();
        $this->fullname=$registration->name;
        $this->email=$registration->email;
        $this->qr_code_url = $image;
        $imageInfo = explode(";base64,", $image);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);
        $image = str_replace(' ', '+', $imageInfo[1]);
        Storage::disk('public')->put("qrcode/$token.$imgExt",base64_decode($image));
        $registration->qrcode()->update([
            'url' => $this->qr_code_url,
            'token' => $token,
        ]);
        $this->sendSuccessMail($token_code,$base64image);
    }

    protected function verifyToken(string $token): string
    {
        $exist = QrCode::where('token', $token)->exists();
        if ($exist) {
            $this->verifyToken($this->generateRandomHex());
        }
        return $token;
    }

    private function generateRandomHex() {
        return strtoupper(dechex(mt_rand(0x10000000, 0xFFFFFFFF)));
    }

    private function sendSuccessMail($token_code,$image):void
    {

        $body = "<p style='text-align:center;'>Thank you,  <b>{$this->fullname}</b> for registering.</p>";
        $body .= "<p style='text-align:center;'>You are all signed up for <b>Zenith Bank Tech Fair - Future Forward 4.0.</b></p>";
        $body .= "<p style='text-align:center; font-weight:bold'>Theme: Embedded Finance, Cybersecurity & Growth Imperative – The Impact of AI.</p>";
        $body .= "<p><b>Address: </b>Eko Hotels and Suites, Plot 1415, Adetokunbo Ademola Street, Victoria Island, Lagos</p>";
        $body .= "<p><b>Date: </b>Thursday, November 21, 2024.</p>";
        $body .= "<p><b>Time: </b>8:00 am</p>";
        $body .= "<div style='text-align:center'><img src='https://www.zbtechfair.com/qrcode/$token_code.png' alt='$token_code.png' style='width:50%' /></div>";
        $body .= "<p><b>Access Code: </b><b style='color:red'>$token_code</b>.</p>";
        $payload = [
            'username' => $this->fullname,
            'email' => $this->email,
            'subject' => "{$this->fullname}, thank you for registering for the event",
            'body' => $body
        ];

        Mail::to($this->email)->send(new GeneralNotificationMail(
            json_encode($payload)
        ));

    }


}
