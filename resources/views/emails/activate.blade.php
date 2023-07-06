@component('mail::message')
# Hello {{ $name }},

Please activate your account by clicking the button below:

@component('mail::button', ['url' => $activationUrl])
Confirm email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent