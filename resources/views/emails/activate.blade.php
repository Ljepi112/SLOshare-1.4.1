@component('mail::message')
# {{ __('email.register-header') }} {{ config('other.title') }} !
**{{ __('email.register-code') }}**


Dobrodošli v največjem slovenskem omrežju za prosto izmenjavo informacij! V pozdravnem sporočilu nekaj kratkih navodil,
ki vam bodo pomagali brezkrbno in prijetno udejstovanje v naši skupnosti.


1. Uvod v skupnost SLOshare

SLOshare je interaktivni portal, ki povezuje uporabnike, do proste izmenjave informacij v svojem lastnem omrežju. Na
portalu vsebuje SLEDILNIK (TRACKER), ki temelji na protokolu Bittorent. Torenti, med katerimi lahko v sekciji Brskaj,
so datoteke, ki vrsto informacij in lasnosti o mnogih ostalih datotekah. To pomeni, da vam te datoteke predstavljajo
most do odjemanja vseh možnih ostalih vsebin.



2. Kaj potrebujem?


Za delovanje na našem portalu potrebujete aktivni registriran račun na spletni strani sloshare.eu, kar vam je ravnokar
uspelo. Nato je potreben "Torrent client" oz. program, ki vam bo omogočal snemanje in branje .torrent datotek iz našega
portala. Na portalu sloshare.eu je najpogosteje uporabljen in tudi toplo priporočen program qBittorrent (<a href="https://www.qbittorrent.org/">www.qbittorrent.org</a>)
(Windows, Linux, macOS in ostala platforma).



3. Kaj so številke zgoraj desno ob navigaciskem meniju? Kaj je ratio?


Da ostane naš portal stabilen in omrežje karseda hitro, deluje na portalu sistem uporabniških razmerij (ratio). Zgoraj lahko
vidite pri prvi puščici količino vašega prenosa podatkov, pri drugi količino oddanih podatkov, na naslednji vidite koliko 
imate aktivnih torrentov. Na predzadnji pa vidite koliko imate trenutnih prenosov, pri zadnji ikoni pa je izračunano vaše 
delilno razmerje. <span style="color: #FF0000; font-weight: bold;">Za obstoj na našem portalu je pomembno, da delite prenešeno vsebino z drugimi uporabniki minimalno 3 dni 
in držite razmerje nad 1.</span> Če torej prenesete 1.700GB veliko datoteko, morate tudi najmanj 1.700GB in 3 dni tudi odsejati.
V kolikor imate razmerje pod 1 dlje časa, boste po 5ih opozorilih izključeni iz portala.


Ko končate vaše prenose torej pustite vaš torrent client še prižgan in datotek ne dajajte na pavzo ali izbrišite, da
sejete podatke še ostalim uporabnikom na portalu in tako pripomorete k zdravem omrežju.


Razmerje je možno povišati tudi priloženimi donacijami SLOshare.


V zgornjih točkah smo vam na kratko predstavili kaj lahko vi pričakujete od našega portala in kaj ostali uporabniki
pričakujejo od vas. Naprošamo vas, da si preberete še naš Pravilnik, Pravni pouk in FAQ.

Delimo, povejmo naprej in se skupaj družimo in zabavajmo :)


Vaša ekipa {{ config('other.title') }}.


Na voljo smo Vam tudi po E-Mail naslovu v primeru težave ali predlogov.
<br>
E-Mail: <a href="mailto:info@sloshare.eu">info@sloshare.eu</a>


@component('mail::button', ['url' => route('activate', $code), 'color' => 'blue'])
{{ __('email.activate-account') }}
@endcomponent

<p>{{ __('email.register-footer') }}</p>
<p style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ route('activate', $code) }}</p>
@endcomponent
