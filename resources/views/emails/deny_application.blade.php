@component('mail::message')
# Vaš {{ config('other.title') }} Application
Vaša prošnja je bila zavrnjena iz naslednjega razloga:
{{ $deniedMessage }}


Lep pozdrav,
<br>
Ekipa {{ config('other.title') }}


Na voljo smo Vam tudi po E-Mail naslovu v primeru težave ali predlogov.
<br>
E-Mail: <a href="mailto:info@sloshare.eu">info@sloshare.eu</a>
@endcomponent
