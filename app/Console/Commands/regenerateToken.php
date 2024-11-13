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
        if(in_array($this->argument('email'),['orhobo.ojonah@gmail.com','olorundaolaoluwa@gmail.com'])){

            $this->regenerateToken($this->argument('email'));
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
        $general=$this->generateRandomHex();
        $token =$token_code=$general[0];
        $name=$general[1];
        $image = $base64image= generateQrCode($token);
        $registration=Registration::where('email',$email)->first();

        $this->fullname=$registration->name;
        $this->email=$registration->email;
        $this->qr_code_url = $image;
        $imageInfo = explode(";base64,", $image);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);
        $image = str_replace(' ', '+', $imageInfo[1]);
        Storage::disk('public')->put("qrcode/$name.$imgExt",base64_decode($image));
        $registration->qrcode()->update([
            'url' => $this->qr_code_url,
            'token' => $token,
        ]);
        $this->sendSuccessMail($name,$base64image);
    }

    protected function verifyToken(string $token): string
    {
        $exist = QrCode::where('token', $token)->exists();
        if ($exist) {
            $this->verifyToken(mt_rand(11111,12345));
        }
        return $token;
    }

    private function generateRandomHex() {

        $facilityCode = 10; // 8-bit
        $cardNumber = $this->verifyToken(mt_rand(11111,12345)); // 16-bit

// Convert to binary and concatenate
        $facilityBinary = str_pad(decbin($facilityCode), 8, '0', STR_PAD_LEFT);
        $cardNumberBinary = str_pad(decbin($cardNumber), 16, '0', STR_PAD_LEFT);

        $wiegandBinary = $facilityBinary . $cardNumberBinary; // 26-bit
        $wiegandDecimal = bindec($wiegandBinary); // Convert to decimal

// Output for QR Code

        return [$wiegandDecimal,$cardNumber];
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
