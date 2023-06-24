<x-mail::message>
Hi {{ $user->first_name }},<br>

We welcome you at our platform. You have created an account with us and its activation requires your email verification.
Kindly visit the link below or click on the button to verify your email.

@if($user->verification_token)
<x-mail::button :url="route('user.email.verification', ['token' => $user->verification_token])" color="success">
    Verify Email
</x-mail::button>
<br>
<div style="text-align:center; font-size: small;">
    If the button above does not work, copy and paste this link into your browser:<br />
    {{ route('user.email.verification', ['token' => $user->verification_token]) }}
</div>
<br>
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
