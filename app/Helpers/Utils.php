<?php

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Stevebauman\Purify\Facades\Purify;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;

function verifyEmailAddress(string $email): bool
{
    $params = array(
        "address" => $email
    );
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, 'api:' . config('services.mailgun.secret'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v4/address/validate?provider_lookup=true');
    $result = curl_exec($ch);
    curl_close($ch);
    $res = json_decode($result);
    info("Email Validation Response:" . json_encode($res));
    if (optional($res)->result == "deliverable") {
        return true;
    }
    return false;
}

function cleaner(string $input): string
{
    $cleaned = Purify::clean($input);
    return trim($cleaned);
}

function generateQrCode(string $data)
{
    $writer = new PngWriter();
    $qrCode = QrCode::create($data)
        ->setEncoding(new Encoding('UTF-8'))
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(410)
        ->setMargin(10)
        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0));

    $result = $writer->write($qrCode);
    return $result->getDataUri();
}
