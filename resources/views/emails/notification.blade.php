@component('mail::message')
<div style="text-align: center; margin-bottom: 5%">
    <img src="https://zbtechfair.com/assets/images/logo_black.png" style="" alt="">
</div>

{!! $data->body !!}

<br>
<p>You will need to come to the venue with the QR code for access.</p>
<p>For any inquiries send us an email at <a href="mailto:zenithdirect@zenithbank.com">zenithdirect@zenithbank.com</a></p>
<p>If you would like to open an account with us, click the link below <br><a href="https://acctgw.zenithbank.com/OnlineAccountOpening" target="_blank">https://acctgw.zenithbank.com/OnlineAccountOpening</a></p>
@endcomponent
