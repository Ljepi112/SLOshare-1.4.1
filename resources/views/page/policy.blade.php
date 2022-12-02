@extends('layout.default')

@section('title')
    <title>{{ __('page.title-policy') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('page.title-policy') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
       {{ __('page.title-policy') }}
    </li>
@endsection

@section('content')
     <div class="container box">
         <div class="col-md-12 page">
             <div class="header gradient silver">
                 <div class="inner_content">
                     <div class="page-title">
                         <h1>{{ __('page.title-policy') }}</h1>
                     </div>
                 </div>
             </div>
             <article class="page-content">
		        <font size="4">
			        <span style="font-weight: bold;">
				        <span style="color: #1877f2;">
				            SPLOŠNA PRAVILA
				        </span>
			        </span>
		        </font>
		        <br>
		        <br>
		        - VSE torrente je potrebno sejati vsaj <span style="color: #FF0000; font-weight: bold;">72 ur</span> oziroma <span style="color: #FF0000; font-weight: bold;">3 dni</span>.<br>
		        - Preden začnete uporabljati stran si preberite &nbsp;<a href="https://www.sloshare.eu/pages/faq" target="_blank">FAQ</a>, pravilnik, pravni pouk in ostale vodiče.<br>
		        - Upoštevajte želje in opozorila osebje SLOshare.eu.<br>
		        - Za storjen hit&amp;run (potegni&amp;pobegni) prejmete opozorilo ali blokado prenosa (za večkratno početje dobite ban).<br>
		        - Ne opozarjajte drugih uporabnikov naj si popravijo razmerje.<br>
		        - Ne opozarjajte nalagalcev o napakah pri torrentu, za to bo poskrbelo ekipa SLOshare.eu (za večje napake pišite osebje SLOshare.eu).<br>
		        - Nalaganje torrentov z zakonsko sporno vsebino (otroska pornografija, zoofilija) je striktno <span style="color: #FF0000; font-weight: bold;">PREPOVEDANO</span>!<br>
		        - Če mislite da ste po krivem kaznovani obvestite osebje SLOshare.eu.<br>
		        - Uporabnik lahko dobi opozorilo za določen ali nedoločen čas. Večkratno kršenje pravil sledi odstranitev iz trackerja.<br>
		        - Vsak uporabnik je dolžan pravila redno prebirati, saj se pogosto spreminjajo.<br>
		        <br>
		        <span style="font-weight: bold;">
		            <span style="color: #1877f2;">
		                PRAVILA PROFILA
		            </span>
		        </span>
		        <br>
		        <br>
		        - Avatarjev ne cenzuriramo, v kolikor ne vsebujejo direktnih žaljivk ali groženj.<br>
		        - Profil naj ne vsebuje vsebine usmerjene proti portalu. Če vam kaj ni všeč odkorakajte.<br>
		        - Info naj ne vsebuje direktnih groženj in kletvic namenjenih dotičnim osebam (pravnim ali fizičnim).<br>
		        - Prepovedano je ustvarjati dvojni profil. Vsak dvojni profil bo izbrisan.<br>
		        - Prepovedana uporaba besede "<span style="color: #FF0000; font-weight: bold;">sloshare</span>" v imenu profila. Vsi profili, ki bodo vsebovali "<span style="color: #FF0000; font-weight: bold;">sloshare</span>" bodo <span style="color: #FF0000; font-weight: bold;">BLOKIRANI</span>.<br>
		        <br>
		        <span style="font-weight: bold;">
		            <span style="color: #1877f2;">
		                PRAVILA KOMUNICIRANJA
		            </span>
		        </span>
		        <br>
		        <br>
		        - Za neprimerna obnašanja (Žaljenje ipd.) na forumu ali klepetu prejmete opozorilo ali blokado za določen del strani.<br>
		        - Preklinjanje je dovoljeno, le v kolikor je razvidno, da ne gre za žaljenje in grožnje. V nasprotnem primeru sledi blokada in pozorilo. Hujše kršitve se kaznujejo z BLOKADO računa!<br>
		        - Ne začenjajte raznih prepirov in ne bodite agresivni do drugih uporabnikov.<br>
		        - Spoštujte statuse višje od vašega.<br>
		        - Na forumu ne pišite naj se tema zaklene, premakne, briše,... (te odločitve pripadajo osebju SLOshare.eu).<br>
		        - Ne pišite dvojnih komentarjev (uporabite opcijo UREDI).<br>
		        - Ne ponavljajte komentarja pred vašim.<br>
		        - Kakršnokoli oglaševanje je prepovedano razen. Če se o tem posvetujete z osebjem SLOshare.eu.<br>
		        - Ne pišite z VELIKIMI črkami, ker se to razume kot <span style="color: #FF0000; font-weight: bold;">KRIČANJE</span>.<br>
		        - Preden odprete novo temo se prepričajte o tem ali je že odprta.<br>
		        - Ne pišite komentarjov kateri se ne tičejo teme oziroma ne spadajo v temo.<br>
		        <br>
		        <span style="font-weight: bold;">
		            <span style="color: #1877f2;">
		                PRAVILA KOMENTIRANJA TORRENTOV
		            </span>
		        </span>
		        <br>
		        <br>
		        - Izogibajte se torrentov (ne komentirajte jih) kateri vam niso všeč in jih ne mislite prenesti.<br>
		        - Spoštujte nalagalca in se mu tudi zahvalite.<br>
		        - Pod komentarje ne pišite cd-keyov ali linkov do crackov.<br>
		        - Ne prosite za FREELEECH (to je odločitev osebja SLOshare.eu).<br>
		        <br>
		        <span style="font-weight: bold;">
		            <span style="color: #1877f2;">
		                PRAVILA PRENAŠANJA
		            </span>
		        </span>
		        <br>
		        <br>
		        - Ko torrent prenesete, ga sejete VSAJ <span style="color: #FF0000; font-weight: bold;">72 ur</span> oziroma <span style="color: #FF0000; font-weight: bold;">3 dni</span> ali pa več. Potek za vsak TORRENT lahko spremljate na svojem profilu.<br>
		        - Za storjen hit&amp;run (potegni &amp; pobegni) prejmete opozorilo/prepoved prenosa (za večkratno početje dobite <span style="color: #FF0000; font-weight: bold;">BLOKADO</span> računa).<br>
		        - Uporabniki s slabim razmerjem bodo s časom odstranjeni.<br>
		        - Prepovedano je delno prenašati TORRENT. V primeru ugotovljene kršitve se bo dodelila kazen.<br>
		        <span style="font-weight: bold;">V primeru da že imate prepoved prenosa, lahko ponovno prenesete TORRENTE, pri katerih je bila ugotovoljena kršitev in jih odsejete do razmerja 1.0.</span><br>
		        <br>
		        <br>
		        <span style="font-weight: bold;">
		            <span style="color: #1877f2;">
		                PRAVILA ZA OSEBJE
		            </span>
		        </span>
		        <br>
		        <br>
		        - Osebje ne sme deliti opozoril in banov zgolj iz osebnih razlogov in zamer.<br>
		        - Osebje ne sme podeliti neskončnega opozorila, razen po posvetu z vsaj dvema drugima članoma osebja.<br>
		        - Osebje ne sme izdajati podatkov o uporabniku (ip, mail) tretjim osebam.<br>
		        - Od osebja se pričakuje, da ignorira provokacije drugih straneh (forumi, itd,...).<br>
		        - Osebje ne sme uporabiti podatkov na portalu za lastne zasebne namene (oglaševanje, itd...).<br>
		        - Osebje naj ne BLOKIRA uporabnikov zaradi slabega razmerja, saj to dela skripta samodejno.<br>
		        - Osebje naj ne grozi z kaznimi, ampak jih preprosto podeli, seveda če za to obstaja upravičen vzrok.<br>
		        - Pri podeljevanju kazni naj se napiše vzrok iz katerega se uporabnik lahko nauči kaj je naredil narobe in to skuša popraviti.<br>
		        - Osebje mora izbrisati vsa sporočila ki vsebujejo verske in rasne konflikte, krivcem pa dodeliti opozorilo oziroma onemogočiti dostop do komentiranja, če gre za ponavljajoče kršitve.<br>
		        - Osebje naj ne BLOKIRA dvojnih računov, saj to počne sistem avtomatsko.<br>
		        - Osebje ne sme nagrajevati uporabnikov zgolj zaradi prijateljskih vezi. Vsaka nagrada mora biti zaslužena in utemeljena.<br>
		        - Osebje lahko briše le avatarje ki vsebujejo direktno nasilje in provokacije usmerjene proti SLOshare.eu oz. prikazujejo v slabi luči).<br>
		        - Osebje naj bo s svojim razmerjem in kvaliteti naloženih TORRENTOV vzgled drugim.<br>
		        - Dolžnost osebja je, da ob napakah na strani obvesti programerja/osebje SLOshare.eu.<br>
		        - Osebje ne sme žaliti uporabnikov ali jih izzivati z izjavami.<br>
		        - Članom osebja, ki ne bodo spoštovali pravil se odvzame status.<br>
		        - Osebju se vodi seznam aktivnosti, katera je pogoj za obstanek v osebju. Leni člani osebja bodo ob status.<br>
		        <br>
		        <span style="font-weight: bold;">
		            <span style="color: #1877f2;">
		                INFORMACIJE
		            </span>
		        </span>
		        <br>
		        Za vse dodatne informacije in pomoč si oglejte&nbsp;<a href="https://www.sloshare.eu/pages/faq" target="_blank">https://www.sloshare.eu/pages/faq</a><br>
		        Ob ne upoštevanju zgoraj naštetih pravil, vam bomo prepovedali vstop na stran za določen ali nedoločen čas!
		        <br>
		        <br>
		        <span style="color: #ff0000; font-size: 30px; text-align: cente;">
                ⚠️ Vsebina katera je na SLOshare.eu se ne sme prenalagati na druge trackerje ⚠️
                </span>
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
                title: '<strong>Ste prebrali SLOshare Pravila?</strong>',
                text: 'Ali popolnoma razumete naša pravila?',
                text: 'Če jih ne, nam pišite!',
                icon: 'question',
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> SEM SEZNANJEN Z PRAVILI!',
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
                      title: 'Hvala! za razumevanje naših SLOshare pravil!'
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