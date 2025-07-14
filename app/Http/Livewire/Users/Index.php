<?php

namespace App\Http\Livewire\Users;

use App\Models\QrCode;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Registration;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Services\NetCoreMailService;
use App\Rules\PhoneNumberRule;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    public bool $show_consent = true;
    public $step_one = true;
    public $final_step = false;
    public $fullname;
    public $company;
    public $job_title;
    public $phone;
    public $email;
    public $qr_code_url;
    public $consent;
    public $zenith_customer = 'yes';

    public function render()
    {
        return view('livewire.users.index')->extends('layouts.app')->section('content');
    }

    public function createBooking()
    {
        $this->validate([
            'email' => ['required', 'string', 'email', 'unique:registrations,email'],
            'fullname' => ['required', 'string', 'min:3'],
            'company' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'unique:registrations,phone'],
            'zenith_customer' => ['required', 'string', Rule::in(['yes', 'no'])]
        ]);

        $this->fullname = cleaner($this->fullname);
        $this->email = cleaner($this->email);
        $this->phone = cleaner($this->phone);
        $this->company = cleaner($this->company);
        $this->consent = cleaner($this->consent);
        $this->zenith_customer = cleaner($this->zenith_customer);

        try {
            DB::beginTransaction();
            $registration = Registration::create([
                'name' => $this->fullname,
                'email' => $this->email,
                'phone' => $this->phone,
                'company' => $this->company,
                'consent' => $this->consent,
                'is_zenith_customer' => $this->zenith_customer
            ]);

            $token = $this->verifyToken("ZEN-" . Str::random(5) . "-" . mt_rand(1000, 9999));
            $image = generateQrCode(route('portal.view-registration', $token));

//            $this->qr_code_url = Cloudinary::upload($image)->getSecurePath();
//
//            $registration->qrcode()->create([
//                'url' => $this->qr_code_url,
//                'token' => $token,
//            ]);

            $this->qr_code_url = $image;//Cloudinary::upload($image)->getSecurePath();
            $this->token_show=$token;
            $imageInfo = explode(";base64,", $image);
            $imgExt = str_replace('data:image/', '', $imageInfo[0]);
            $image = str_replace(' ', '+', $imageInfo[1]);
            Storage::disk('public')->put("qrcode/$token.$imgExt", base64_decode($image));
            $this->qr_code_url=route('image',['path'=>"qrcode/$token.$imgExt"]);

            $registration->qrcode()->create([
                'url' => $this->qr_code_url,
                'token' => $token,
            ]);


            $body = "<p style='text-align:center; font-weight:bold'>Thank you,  {$this->fullname}</p>";
            $body .= "<p style='text-align:center;'>You are all signed up for <b>The Zenith Bank International Trade Seminar.</b></p>";
            $body .= "<p style='text-align:center; font-weight:bold'>Theme: Unlocking Value and Harnessing Growth</p>";
            $body .= "<p><b>Address: </b>The Civic Centre, Ozumba Mbadiwe, Victoria Island, Lagos.</p>";
            $body .= "<p><b>Date: </b>Thursday, August 14, 2025.</p>";
            $body .= "<p><b>Time: </b>9:00 am</p>";
            $body .= "<div style='text-align:center'><img src='{$this->qr_code_url}' style='width:50%' /></div>";

            $payload = [
                'username' => $this->fullname,
                'email' => $this->email,
                'subject' => "{$this->fullname}, thank you for registering for the event",
                'body' => $body
            ];

            try {
                $netcoreMailService = new NetCoreMailService();
                $success = $netcoreMailService->sendEmail(
                    $this->email,
                    $this->fullname,
                    $payload['subject'],
                    $body
                );

                if (!$success) {
                    DB::rollback();
                    \Log::error("NetCore Mail Sending Error");
                }
            } catch (\Exception $e) {
                DB::rollback();
                \Log::error("Mail Sending Error:".json_encode($e->getMessage()));
            }

            DB::commit();

            $this->step_one = false;
            $this->final_step = true;
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error("Error Saving Registration:".json_encode($th->getMessage()));
            flash()->addFlash('error', 'Whoops!!! Something went wrong...');
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

}
