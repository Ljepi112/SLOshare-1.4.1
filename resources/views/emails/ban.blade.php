@component('mail::message')
# {{ __('email.banned-header') }}!
**Razlog:** {{ $ban->ban_reason }}


Lep pozdrav,
<br>
Ekipa {{ config('other.title') }}


Na voljo smo Vam tudi po E-Mail naslovu v primeru težave ali predlogov.
<br>
E-Mail: <a href="mailto:info@sloshare.eu">info@sloshare.eu</a>
*{{ __('email.banned-footer') }}*
@endcomponent
