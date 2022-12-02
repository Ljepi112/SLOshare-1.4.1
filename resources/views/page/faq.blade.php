@extends('layout.default')

@section('title')
    <title>{{ __('page.title-faq') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('common.faq') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ __('page.title-faq') }}
    </li>
@endsection

@section('content')
     <div class="container box">
         <div class="col-md-12 page">
             <div class="header gradient silver">
                 <div class="inner_content">
                     <div class="page-title">
                         <h1>{{ __('page.title-faq') }}</h1>
                     </div>
                 </div>
             </div>
             <article class="page-content">
            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Kaj je FAQ in čemu služi?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
                FAQ ali angleško "Frequently asked questions" ali slovensko "Pogosto zastavljena vprašanja" je stran, kjer objavljamo odgovore na vprašanja, katera so največkrat zastavljena.
            </div>
            </div>

            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Registriral sem se, nisem pa dobil potrditvenega sporočila!
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
                Preverite poštni predal pod 'SPAM' ali 'Nezaželjena pošta'. Določeni ponudniki E-Mail storitev naša sporočila niti ne dostavijo. Najbolj priporočljivo se je registrirat s Gmail poštnim računom.
            </div>
            </div>

            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Pozabil sem geslo, kako ga lahko dobim ali ponastavim?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
                Geslo lahko ponastaviš <a target="_blank" href="https://www.sloshare.eu/password/reset">tukaj</a> podatki za prijavo bodo poslani na vaš E-Mail.
				Osebje vam ne more posredovati vašega gesla, saj ga ne more prebrat ker je šifrirano v podatkovni bazi.
            </div>
            </div>

            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Ne morem se več prijavit!? / Prijava ne deluje!
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
                Ponavadi je težava v piškotkih. Zaprite vse zavihke v brskalniku. Odprite Možnosti in pobrišite vse piškotke. Poskusite se prijaviti.
				V primeru da se še vedno ne morete prijaviti, kontaktirajte naše osebje na naši Facebook strani: https://www.facebook.com/
			</div>
            </div>
			
            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Zakaj sem zaveden kot nepovezljiv?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
                Sledilnik je zaznal, da ne sprejemate prihodnih povezav.
				<br>
				To pomeni, da se aktivni soležniki ne morejo povezati z vami, edino vi se povezujete z njimi.
				<br>
				Še slabše je, da sta dva soležnika v takšnem stanju, kar pomeni, da se sploh ne moreta povezati med seboj.
				<br>
				Vse skupaj pa ima vpliv na hitrost prenašanja.
				<br>
				Rešitev je v odpiranju portov na dohodnih povezavah (enako območje kot ste definirali v klientu) v požarnem zidu in/ali nastavitev NAT serverja, da uporablja to območje, namesto NAPT (dejanski proces je različen, odvisen je od modela routerja/usmerjevalnika. 
				<br>
				Preverite dokumentacijo ali forum za podporo. Precej informacij boste našli na PortForward ali pa pri vašem ponudniku internetnih storitev, kjer vam lahko na željo porte tudi odprejo).
			</div>
            </div>
			
            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Zakaj ne morem naložiti torrenta? / Kako postanem nalagalec?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
                Samo pooblaščeni uporabniki Uploader in VIP imajo to možnost. Če bi radi postali nalagalec se nam javite.
			</div>
            </div>
			
            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Kaj je moje razmerje?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
                Razmerje prikazuje za deljenje in snemanje torrent datotek, torej koliko delite in koliko snamate od drugih soležnikov.
				<br>
				Drugače tudi angleško "Upload" in "Download" ratio. S tem se meri kako "pridni" ste oz. koliko delite naprej torrente katere prenesete.
			</div>
            </div>

            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Lahko uporabljam katerikoli torrent klient?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
				Načeloma so dovoljeni vsi torrent klienti razen teh:
				<br>
				BitTorrent++
				<br>
				Nova Torrent
				<br>
				TorrentStorm
				<br>
				Ti klienti v primeru ukinitve/dokončanja torrent seje, ne poročajo pravilno.
				<br>
				V primeru uporabe zna biti seštevek napačen in torrenti znajo biti zavedeni v vašem profilu še kar nekaj časa po prekinitvi.
				<br>
				Vsekakor se izogibajte alfa in beta verzijam.
			</div>
            </div>

            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Kateri port/vrata naj uporabljam na torrent klientu?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
				V vašem torrent klientu (in tudi usmerjevalniku/požarnem zidu) nastavite vrata med 6900 - 61235.
			</div>
            </div>

            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Zakaj se ne morem prijaviti, če uporabljam proxy?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
				Prijave/uporabe računov izza proxyja ne dovoljujemo.
			</div>
            </div>

            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Zakaj imam onemogočen račun?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
				Razlogov je lahko več:
				<br>
				- Zamenjali ste ponudnika internetnih storitev? (preventivno onemogočen račun)
				<br>
				- Kršili ste pravila naše spletne strani? (več računov, ne sejanje, ne dokončanje torrenta,...)
				<br>
				Kontaktirajte naše osebje, da pogledajo in rešijo zadevo.
			</div>
            </div>
			
            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Imam visoko razmerje prenešenih torrentov, zakaj sem dobil prepoved prenašanja?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
				Čeprav imate visoko razmerje prenešenih torrentov, še ne pomeni da ste jih vse odsejali po pravilih naše spletne strani.
				<br>
				Poglejte na vašem profilu med končanimi torrenti kateri imajo rdeče značke, te je treba odsejat po pravilih (1:1 razmerje ali 96ur skupnega sejanja).
				<br>
				Kontaktirajte naše osebje, da pogledajo in rešijo zadevo.
			</div>
            </div>
			
            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer;" @click="show = !show">
                    Kaj pomeni CAM/TS/TC/DVDSCR pri filmih?
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
				Te oznake vam povedo na kakšen način je video vsebina pridobljena in kakšno kvaliteto lahko pričakujete.
				<br>
				Kaj več si lahko preberete tukaj na <a target="_blank" href="https://en.wikipedia.org/wiki/Pirated_movie_release_types">Wikipediji</a> ali pa še bolj podrobno na <a target="_blank" href="https://scenerules.org/">https://scenerules.org/</a>
			</div>
            </div>

             </article>
         </div>
     </div>
@endsection

@section('javascripts')
    @if(request()->url() === config('other.rules_url') && auth()->user()->read_rules == 0)
        <script nonce="{{ SLOYakuza\SecureHeaders\SecureHeaders::nonce('script') }}">
          window.onscroll = function () {
            let scrollHeight, totalHeight
            scrollHeight = document.body.scrollHeight
            totalHeight = window.scrollY + window.innerHeight

            if (totalHeight >= scrollHeight) {
              Swal.fire({
                title: '<strong>Ste prebrali SLOshare FAQ?</strong>',
                text: 'Ali popolnoma razumete naš FAQ?',
                text: 'Če jih ne, nam pišite!',
                icon: 'question',
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> SEM SEZNANJEN Z FAQ!',
              }).then(function () {
                $.ajax({
                  url: '/users/accept-rules',
                  type: 'post',
                  data: {
                    _token: '{{ csrf_token() }}'
                  },
                  success: function (response) {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    })

                    Toast.fire({
                      icon: 'success',
                      title: 'Hvala! Za razumevanje našega SLOshare FAQ-ja!'
                    })
                  },
                  failure: function (response) {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    })

                    Toast.fire({
                      icon: 'error',
                      title: 'Nekaj je šlo narobe!'
                    })
                  }
                })
              })
            }
          }

        </script>
    @endif
@endsection