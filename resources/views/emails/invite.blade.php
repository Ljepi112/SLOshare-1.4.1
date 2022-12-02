@component('mail::message')
# {{ __('email.invite-header') }} {{ config('other.title') }} !
**{{ __('email.invite-message') }}:** {{ __('email.invite-invited') }} {{ config('other.title') }}. {{ $invite->custom }}
@component('mail::button', ['url' => route('register', $invite->code), 'color' => 'blue'])
{{ __('email.invite-signup') }}


Lep pozdrav,
<br>
Ekipa {{ config('other.title') }}


Na voljo smo Vam tudi po E-Mail naslovu v primeru težave ali predlogov.
<br>
E-Mail: <a href="mailto:info@sloshare.eu">info@sloshare.eu</a>
@endcomponent
<p>{{ __('email.register-footer') }}</p>
<p style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ route('register', $invite->code) }}</p>
@endcomponent
