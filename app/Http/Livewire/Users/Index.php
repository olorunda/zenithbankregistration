<?php

namespace App\Http\Livewire\Users;

use App\Models\QrCode;
use Illuminate\Support\Facades\Storage;
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
    public bool $show_consent = true;
    public $step_one = true;
    public $final_step = false;
    public $firstname,$lastname;
    public $company;
    public $job_title;
    public $phone;
    public $email;
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


    public function createBooking()
    {
//dd($this->phone);
        $this->validate([
            'email' => ['required', 'string', 'email', 'unique:registrations,email'],
            'firstname' => ['required', 'string', 'min:3'],
            'lastname' => ['required', 'string', 'min:3'],
//            'company' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'unique:registrations,phone'],
            'zenith_customer' => ['required', 'string', Rule::in(['yes', 'no'])],
            'reason_for_attending' => ['required'],
            'attending_masterclass' => ['required', Rule::in(['yes', 'no'])],
//            'master_classes' => ['required:if:attending_masterclass,==,yes']
        ]);


        $this->fullname = cleaner($this->firstname.' '.$this->lastname);
        $this->email = cleaner($this->email);
        $this->phone = cleaner($this->phone);
//        $this->company = cleaner($this->company);
        $this->consent = cleaner($this->consent);
        $this->zenith_customer = cleaner($this->zenith_customer);
        $this->reason_for_attending = cleaner($this->reason_for_attending);
        $this->attending_masterclass = cleaner($this->attending_masterclass);
        $this->master_classes = cleaner($this->master_classes);


        try {
            $token =$token_code= $this->verifyToken("ZEN-" . Str::random(5) . "-" . mt_rand(1000, 9999));
            $image = $base64image= generateQrCode(route('portal.view-registration', $token));

            DB::transaction(function () use ($token,$image){
                $registration = Registration::create([
                    'name' => $this->fullname,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'company' => '',
                    'consent' => $this->consent,
                    'reason_for_attending' => $this->reason_for_attending,
                    'attending_masterclass' => $this->attending_masterclass,
                    'master_classes' => $this->master_classes,
                    'is_zenith_customer' => $this->zenith_customer
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
            $this->error_message='Whoops!!! Something went wrong...';
            return;
        }
    }


    public function attestConsent(): void
    {
        $this->consent = 'yes';
        $this->show_consent = false;
    }


    public function rejectConsent(): void
    {
        $this->consent = 'no';
    }

    protected function verifyToken(string $token): string
    {
        $exist = QrCode::where('token', $token)->exists();
        if ($exist) {
            $this->verifyToken($token);
        }
        return $token;
    }

    private function sendSuccessMail($token_code,$image):void
    {

        $body = "<p style='text-align:center; font-weight:bold'>Thank you,  {$this->fullname}</p>";
        $body .= "<p style='text-align:center;'>You are all signed up for <b>2024 Zenith Bank Tech Fair.</b></p>";
        $body .= "<p style='text-align:center; font-weight:bold'>Theme: Embedded Financing, Cybersecurity & Growth Imperatives</p>";
        $body .= "<p><b>Address: </b>The Civic Centre, Ozumba Mbadiwe, Victoria Island, Lagos.</p>";
        $body .= "<p><b>Access Code: </b>$token_code.</p>";
        $body .= "<p><b>Date: </b>Thursday, November 21, 2024.</p>";
        $body .= "<p><b>Time: </b>8:00 am</p>";
        $body .= "<div style='text-align:center'><img src='https://www.zbtechfair.com/qrcode/$token_code.png' alt='$token_code.png' style='width:50%' /></div>";

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
