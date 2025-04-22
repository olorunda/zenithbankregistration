<?php

namespace App\Http\Livewire\Users;

use App\Models\QrCode;
use App\Models\ValidatedUser;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Registration;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralNotificationMail;
use App\Rules\PhoneNumberRule;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{

    public  $show_consent = 'display:none';

    public $step_one = true;
    public $final_step = false;
    public $firstname,$lastname,$ran_error_message;
    public $company;
    public $validated_ran=false;
    public $job_title;
    public $phone,$name;
    public $email;
    public $ran='';
    public $qr_code_url;
    public $consent;
    public $zenith_customer = 'no';
    public string $reason_for_attending='';
    public string $master_classes='';
    public string $attending_masterclass='';
    protected $listeners = ['hideOtherClasses'];
    public string $show_masterclasses='display:none';
    public string $error_message='';
    /**
     * @var mixed|string
     */
    public string $token_show='';
    public string $consent_error_message;
    private $data_val;
    public string $close_terms_and_condition='';

    public function render()
    {
        return view('livewire.users.index')->extends('layouts.app')->section('content');
    }

    public function attendingMasterClass(){

        $this->show_masterclasses='display:none';
        if($this->attending_masterclass == 'yes'){
            $this->show_masterclasses='';
        }
    }

    public function validateRan()
    {

        $this->data_val=ValidatedUser::where('ran',$this->ran)->orderby('id','desc')->first();

        if(!$this->data_val){
            $this->ran_error_message='Invalid Ran Code Please Try Again with a correct ran code';
            return;
        }
        $this->ran_error_message='';
        $this->validated_ran=true;
        $this->name=$this->data_val->name;
        $this->email=$this->data_val->emails;

    }


    public function createBooking()
    {


//dd($this->phone);
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'name' => ['required', 'string', 'min:3'],
//            'company' => ['required', 'string', 'min:3'],


//            'master_classes' => ['required:if:attending_masterclass,==,yes']
        ]);


        $this->data_val=ValidatedUser::where('ran',$this->ran)->orderby('id','desc')->first();

        $this->fullname = cleaner($this->name);
        $this->email = cleaner($this->email);
//        $this->company = cleaner($this->company);
        $this->consent = ($this->consent);
        $this->error_message='';
        if(!$this->consent){
            $this->error_message='Please Agree to the terms and conditions before submitting';
            return;
        }
        if(!$this->data_val){
            $this->ran_error_message='Invalid Ran Code Please Try Again with a correct ran code';
            $this->name='';
            $this->email='';
            return;
        }

        try {
            $this->ran_error_message='';
//            $token =$token_code= $this->verifyToken(mt_rand(10000, 99999));

//            $token =$token_code= $this->verifyToken($this->generateRandomHex());

            $token =$token_code=$this->generateRandomHex();

            $image = $base64image= generateQrCode($token);

            DB::transaction(function () use ($token,$image){
                $registration = Registration::updateOrCreate(['email' => $this->email],[
                    'name' => $this->fullname,
                    'email' => $this->email,
                    'phone' => $this->data_val->phone_num.mt_rand(11111,22222),
                    'ran' => $this->data_val->ran,
                    'company' => '',
                    'consent' => $this->consent ? 'yes' :'no',
                    'reason_for_attending' => 'N/A',
                    'attending_masterclass' => 'no',
                    'master_classes' => 'no',
                    'is_zenith_customer' => 'no'
                ]);

                $this->qr_code_url = $image;//Cloudinary::upload($image)->getSecurePath();
                $this->token_show=$token;
                $imageInfo = explode(";base64,", $image);
                $imgExt = str_replace('data:image/', '', $imageInfo[0]);
                $image = str_replace(' ', '+', $imageInfo[1]);
                Storage::disk('public')->put("qrcode/$token.$imgExt",base64_decode($image));

                $registration->qrcode()->create([
                    'url' => $this->qr_code_url,
                    'token' => $token,
                ]);


            });

            $this->step_one = false;
            $this->final_step = true;
            $this->sendSuccessMail($token_code,$base64image);

        } catch (\Exception $ex) {

            \Log::error("Error Saving Registration:" . json_encode($ex->getMessage()));
            $this->error_message='Whoops!!! Something went wrong...'.$ex->getMessage();
            return;
        }
    }

    public function showConsent()
    {
        $this->show_consent='';
    }

    public function closeTermsAndCondition(): void
    {
        $this->close_terms_and_condition = 'yes';
        $this->show_consent = 'display:none';
    }




    protected function verifyToken(string $token): string
    {
        $exist = QrCode::where('token', $token)->exists();
        if ($exist) {
            return $this->verifyToken(mt_rand(100000,555555));
        }
        return $token;
    }

    private function generateRandomHex() {

        $facilityCode = 10; // 8-bit
        $cardNumber = $this->verifyToken(mt_rand(100000,555555)); // 16-bit

// Convert to binary and concatenate
        $facilityBinary = str_pad(decbin($facilityCode), 8, '0', STR_PAD_LEFT);
        $cardNumberBinary = str_pad(decbin($cardNumber), 16, '0', STR_PAD_LEFT);

        $wiegandBinary = $facilityBinary . $cardNumberBinary; // 26-bit
        $wiegandDecimal = bindec($wiegandBinary); // Convert to decimal

// Output for QR Code

        return $wiegandDecimal;
    }


    private function sendSuccessMail($token_code,$image):void
    {
//        $body=
        $body = "<p>Thank you for registering for the <strong>Annual General Meeting</strong> of <strong>Zenith Bank Plc</strong>";
//        $body .= "<p style='text-align:center;'>You are all signed up for <b>Zenith Bank Tech Fair - Future Forward 4.0.</b></p>";
//        $body .= "<p style='text-align:center; font-weight:bold'>Theme: Embedded Finance, Cybersecurity & Growth Imperative – The Impact of AI.</p>";
        $body .= "<p><b>Address: </b>Civic Towers, Ozumba Mbadiwe Avenue, Victoria Island, Lagos</p>";
        $body .= "<p><b>Date: </b>29th April 2025.</p>";
        $body .= "<p><b>Time: </b>9:00 am</p>";
        $body .= "<div style='text-align:center'><img src='https://34thzbagm.verimeetings.com/qrcode/$token_code.png' alt='$token_code.png' style='width:50%' /></div>";
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
