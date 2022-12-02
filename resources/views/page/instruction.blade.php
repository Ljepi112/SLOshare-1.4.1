@extends('layout.default')

@section('title')
    <title>{{ __('page.title-instructions') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('page.title-instructions') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ __('page.title-instructions') }}
    </li>
@endsection

@section('content')
     <div class="container box">
         <div class="col-md-12 page">
             <div class="header gradient silver">
                 <div class="inner_content">
                     <div class="page-title">
                         <h1>{{ __('page.title-instructions') }}</h1>
                     </div>
                 </div>
             </div>
             <article class="page-content">
            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer; " @click="show = !show">
                    Kako naložiti VIDEO TORRENT na SLOshare.eu
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
				1) Na usmerjevalniku odprete PORT katerega uporablja vaš CLIENT (ODJEMALEC).
                <br>
                <br>
                2) Izberete datoteko katero želite naložiti na TRACKER in jo ustvarite z CLIENTOM (ODJEMALCEM) "IME_TORRENTA.torrent".
                <br>
                <br>
                3) Na strani SLOshare.eu izberemo kategorijo vsebine katero želimo naložiti npr. FILMI.
                <br>
                <br>
                - Nalaganje FreeLeech Torrentov lahko izberete, če vsebina presega 30GB!
                4) Odpre se nam stran kjer moramo izpolniti nalagalni obrazec. Naložimo ustvarjeno datoteko "IME_TORRENTA.torrent", preverimo na TMDB-ju če je vsebina FILMA na strani TMDB-ja in vnesemo ID FILMA katerega najdemo na TMDB-ju. Določeno vsebino obrazca vam lahko izpolni avtomatika. Vnesemo tudi IMDB ID. Če ne najdemo FILMA ali nima slike ne vnašamo TMDB ID vpišemo "0" in vnesemo POSTER ročno. V obeh primerih moramo ročno vnesti OPIS TORRENTA. Ko so polja izpolnjena pritisnemo gumb "Naloži Torrent".
                <br>
                <br>
                5) Odpre se nam nova stran kjer prenesemo TORRENT in ga odpremo. Odpre se CLIENT "ODJEMALEC" poiščemo, kjer imamo shranjeno vsebino TORRENTA katerega smo ustvarili v 1.Koraku.
                <br>
                <br>
                6) CLIENT "ODJEMALEC" preveri vsebino v mapi in dokonča pregled se začne vsebina SEJATI.
                <br>
                <br>
                7) Vsa naložena vsebina se preveri iz strani MODERATORJA ali OSEBJA.
                <br>
                <br>
                <video width="1000" style="margin-left:auto; margin-right:auto; display:block;" controls controlslist="nodownload">
                <source src="{{ url('video/SLOshare_video.mp4') }}" type="video/mp4">
                </video>
            </div>
            </div>

            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer; " @click="show = !show">
                    Kako naložiti TV SERIJO TORRENT na SLOshare.eu
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
				1) Na usmerjevalniku odprete PORT katerega uporablja vaš CLIENT (ODJEMALEC).
                <br>
                <br>
                2) Izberete datoteko katero želite naložiti na TRACKER in jo ustvarite z CLIENTOM (ODJEMALCEM) "IME_TORRENTA.torrent".
                <br>
                <br>
                3) Na strani SLOshare.eu izberemo kategorijo vsebine katero želimo naložiti npr. TV SERIJE.
                <br>
                <br>
                - Nalaganje FreeLeech Torrentov lahko izberete, če vsebina presega 30GB!
                4) Odpre se nam stran kjer moramo izpolniti nalagalni obrazec. Naložimo ustvarjeno datoteko "IME_TORRENTA.torrent", preverimo na TMDB-ju če je vsebina TV SERIJE na strani TMDB-ja in vnesemo ID TV SERIJE katerega najdemo na TMDB-ju. Določeno vsebino obrazca vam lahko izpolni avtomatika. Vnesemo tudi IMDB ID. Če ne najdemo TV SERIJE ali nima slike ne vnašamo TMDB ID vpišemo "0" in vnesemo POSTER ročno. V obeh primerih moramo ročno vnesti OPIS TORRENTA. Ko so polja izpolnjena pritisnemo gumb "Naloži Torrent".
                <br>
                <br>
                5) Odpre se nam nova stran kjer prenesemo TORRENT in ga odpremo. Odpre se CLIENT "ODJEMALEC" poiščemo, kjer imamo shranjeno vsebino TORRENTA katerega smo ustvarili v 1.Koraku.
                <br>
                <br>
                6) CLIENT "ODJEMALEC" preveri vsebino v mapi in dokonča pregled se začne vsebina SEJATI.
                <br>
                <br>
                7) Vsa naložena vsebina se preveri iz strani MODERATORJA ali OSEBJA.
                <br>
                <br>
                <video width="1000" style="margin-left:auto; margin-right:auto; display:block;" controls controlslist="nodownload">
                <source src="{{ url('video/SLOshare_tv-serija.mp4') }}" type="video/mp4">
                </video>
            </div>
            </div>

            <div class="panel panel-chat shoutbox torrent-general" x-data="{ show: false }">
                <h3 style="cursor: pointer; " @click="show = !show">
                    Kako naložiti IGRE TORRENT na SLOshare.eu
                    <i class="{{ config("other.font-awesome") }} fa-plus-circle fa-pull-right" x-show="!show"></i>
                    <i class="{{ config("other.font-awesome") }} fa-minus-circle fa-pull-right" x-show="show"></i>
                </h3>
            <div class="table-responsive" x-show="!show">
            </div>
            <div class="table-responsive" x-show="show">
				1) Na usmerjevalniku odprete PORT katerega uporablja vaš CLIENT (ODJEMALEC).
                <br>
                <br>
                2) Izberete datoteko katero želite naložiti na TRACKER in jo ustvarite z CLIENTOM (ODJEMALCEM) "IME_TORRENTA.torrent".
                <br>
                <br>
                3) Na strani SLOshare.eu izberemo kategorijo vsebine katero želimo naložiti npr. IGRE.
                <br>
                <br>
                4) Odpre se nam stran kjer moramo izpolniti nalagalni obrazec. Naložimo ustvarjeno datoteko "IME_TORRENTA.torrent", preverimo na IGDB-ju če je vsebina IGRE na strani IGDB-ja in vnesemo ID IGRE katerega najdemo na IGDB-ju. Določeno vsebino obrazca vam lahko izpolni avtomatika. Vnesemo OPIS TORRENTA. Ko so polja izpolnjena pritisnemo gumb "Naloži Torrent".
                <br>
                <br>
                5) Odpre se nam nova stran kjer prenesemo TORRENT in ga odpremo. Odpre se CLIENT "ODJEMALEC" poiščemo, kjer imamo shranjeno vsebino TORRENTA katerega smo ustvarili v 1.Koraku.
                <br>
                <br>
                6) CLIENT "ODJEMALEC" preveri vsebino v mapi in dokonča pregled se začne vsebina SEJATI.
                <br>
                <br>
                7) Vsa naložena vsebina se preveri iz strani MODERATORJA ali OSEBJA.
                <br>
                <br>
                <video width="1000" style="margin-left:auto; margin-right:auto; display:block;" controls controlslist="nodownload">
                <source src="{{ url('video/SLOshare_igre.mp4') }}" type="video/mp4">
                </video>
            </div>
            </div>

             </article>
         </div>
     </div>
@endsection
