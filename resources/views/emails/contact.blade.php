@component('mail::message')
# {{ __('email.contact-header') }} {{ $input['email'] }}
**{{ __('email.contact-name') }}:** {{ $input['contact-name'] }}
**{{ __('email.contact-message') }}:** {{ $input['message'] }}


Lep pozdrav,
<br>
Ekipa {{ config('other.title') }}


Na voljo smo Vam tudi po E-Mail naslovu v primeru težave ali predlogov.
<br>
E-Mail: <a href="mailto:info@sloshare.eu">info@sloshare.eu</a>
@endcomponent
