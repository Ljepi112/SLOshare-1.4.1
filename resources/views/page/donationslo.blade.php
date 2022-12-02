@extends('layout.default')

@section('title')
    <title>{{ __('page.title-donation') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('page.title-donation') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
        {{ config('other.title') }} {{ __('common.donation') }}
    </li>
@endsection

@section('content')
    <div class="container box">
        <div class="header gradient silver">
            <div class="inner_content">
                <div class="page-title">
                    <h1>{{ __('page.title-donation') }}</h1>
                </div>
            </div>
        </div>
        <article class="page-content">
            Portal SLOshare.eu je v celoti plod dela ekipe SLOshare, ki se bori za pravice do prostega pretoka informaci v SLOVENIJI
            in v osnovi deluje popolnoma neprofitno, če prav SLOshare marsikateremu članu predstavlja 8-urni delovnik.
            Primarni cilj projekta je spodbujanje in nagrajevanje P2P skupnosti.Ekipa SLOshare se zelo trudi da naredi
            stran moderno in bolj prijazno uporabnikom. Vsa ekipa SLOshare se trudi in vam ponuja številne stare in nove informacije.
            <br>
            <br>
            Zato smo zelo veseli vsakega prostovoljnega prispevka s strani uporabnikov našega in vašega portala. SLOshare
            je v celoti neprofiten, vse fukcije portala so v celoti brezplačne.
            <br>
            <br>
            Vsaka donacija je POPOLNOMA PROSTOVOLJNA. Nobenega od uporabnikov nikakor ne silimo k doniranju.
            <br>
            <br>
            Če želite donirati, lahko to storite preko: <span style="font-weight: bold;">PayPala, debetno ali kreditno kartico</span>.
            <br>
            <br>
            <span style="color: #FF0000; font-weight: bold;">
            DODATNO OBVESTILO: Donacija vas ne opraviči pri neupoštevanju pravil in ne izključuje kazni prepoved uporabe portala!
            </span>
            <br>
            <br>
            Po opravljeni donaciji nam sporočite uporabniško ime na <a href="mailto:donacije@sloshare.eu">donacije@sloshare.eu</a>
            <br>
            Za ostale informacije nam pišite na <a href="mailto:info@sloshare.eu">info@sloshare.eu</a>
        </article>
            <div class="row black-list">
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="text-center black-item">
                            <h4>5€</h4>
                            <p>
                            - VIP
                            <br>
                            - 1 TB UL
                            </p>
                            <form action="https://www.paypal.com/donate" method="post" target="_black">
                            <input type="hidden" name="hosted_button_id" value="9VSKWN3QQJCQU" />
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="Donacija 5€" />
                            </form>
                            <i class="fal fa-euro-sign text-green black-icon"></i>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="text-center black-item">
                            <h4>10€</h4>
                            - VIP
                            <br>
                            - 2 TB UL
                            </p>
                            <form action="https://www.paypal.com/donate" method="post" target="_black">
                            <input type="hidden" name="hosted_button_id" value="RP96883WS92ZJ" />
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="Donacija 10€" />
                            </form>
                            <i class="fal fa-euro-sign text-green black-icon"></i>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="text-center black-item">
                            <h4>15€</h4>
                            - VIP
                            <br>
                            - 5 TB UL
                            </p>
                            <form action="https://www.paypal.com/donate" method="post" target="_black">
                            <input type="hidden" name="hosted_button_id" value="VTBES36PDSMWJ" />
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="Donacija 15€" />
                            </form>
                            <i class="fal fa-euro-sign text-green black-icon"></i>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="text-center black-item">
                            <h4>20€</h4>
                            - VIP
                            <br>
                            - 10 TB UL
                            </p>
                            <form action="https://www.paypal.com/donate" method="post" target="_black">
                            <input type="hidden" name="hosted_button_id" value="9ZSEYX2SXHQPC" />
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="Donacija 20€" />
                            </form>
                            <i class="fal fa-euro-sign text-green black-icon"></i>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
