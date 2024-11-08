@component('mail::message')
<div style="text-align: center; margin-bottom: 5%">
    <img  src="https://zbtechfair.com/assets/images/logo_black.png"  alt="">
</div>
<p style='text-align:center; font-weight:bold'>Thank you,  {{$data->fullname}}</p>
<p style='text-align:center;'>You are all signed up for <b>The Zenith Tech Fair 2024.</b></p>
<p style='text-align:center; font-weight:bold'>Theme:<br> Embedded Financing, Cybersecurity & Growth Imperatives</p>
<p><b>Address: </b>The Civic Centre, Ozumba Mbadiwe, Victoria Island, Lagos.</p>
<p><b>Access Code: </b>{{$data->token_code}}.</p>
<p><b>Date: </b>Thursday, November 21, 2024.</p>
<p><b>Time: </b>8:00 am</p>
<div style='text-align:center'><img src='{{url('qrcode/'.$data->token_code.'.png')}}' alt='{{$data->token_code}}.png' style='width:50%' /></div>
<br>
<p>You will need to come to the venue with the QR code for access.</p>
<p>For any inquiries send us an email at <a href="mailto:zenithdirect@zenithbank.com">zenithdirect@zenithbank.com</a></p>
<p>If you would like to open an account with us, click the link below <br><a href="https://acctgw.zenithbank.com/OnlineAccountOpening" target="_blank">https://acctgw.zenithbank.com/OnlineAccountOpening</a></p>
@endcomponent
