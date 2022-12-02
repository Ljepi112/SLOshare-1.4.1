@extends('layout.default')

@section('title')
    <title>Ukazi - {{ __('staff.staff-dashboard') }}</title>
@endsection

@section('meta')
    <meta name="description" content="Commands - {{ __('staff.staff-dashboard') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('staff.dashboard.index') }}" class="breadcrumb__link">
            {{ __('staff.staff-dashboard') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        Commands
    </li>
@endsection

@section('page', 'page__commands--index')

@section('main')
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 2rem;">
        <section class="panelV2">
            <h2 class="panel__heading">Način vzdrževanja</h2>
            <div class="panel__body">
                <p class="form__group form__group--horizontal">
                    <form role="form" method="POST" action="{{ url('/dashboard/commands/maintance-enable') }}">
                        @csrf
                        <button
                            class="form__button form__button--text"
                            title="Ta ukaz omogoča vzdrževalni način, medtem ko na beli seznam doda samo vaš naslov IP."
                        >
                            Omogoči način vzdrževanja
                        </button>
                    </form>
                </p>
                <p class="form__group form__group--horizontal">
                    <form role="form" method="POST" action="{{ url('/dashboard/commands/maintance-disable') }}">
                        @csrf
                        <button
                            class="form__button form__button--text"
                            title="Ta ukaz onemogoči način vzdrževanja. Varnostna kopija spletnega mesta za dostop vsem."
                        >
                            Onemogoči način vzdrževanja
                        </button>
                    </form>
                </p>
            </div>
        </section>
        <section class="panelV2">
            <h2 class="panel__heading">Predpomnjenje</h2>
            <div class="panel__body">
                <p class="form__group form__group--horizontal">
                    <form method="POST" action="{{ url('/dashboard/commands/clear-cache') }}">
                        @csrf
                        <button
                            class="form__button form__button--text"
                            title="Ta ukaz počisti predpomnilnik vaših spletnih mest. Ta predpomnilnik je odvisen od gonilnika, ki ga uporabljate."
                        >
                            Počistiti začasni pomnilnik
                        </button>
                    </form>
                </p>
                <p class="form__group form__group--horizontal">
                    <form method="POST" action="{{ url('/dashboard/commands/clear-view-cache') }}">
                        @csrf
                        <button
                            class="form__button form__button--text"
                            title="Ta ukaz počisti predpomnilnik prevedenih pogledov vaših spletnih mest."
                        >
                            Počisti predpomnilnik pogleda
                        </button>
                    </form>
                </p>
                <p class="form__group form__group--horizontal">
                    <form method="POST" action="{{ url('/dashboard/commands/clear-route-cache') }}">
                        @csrf
                        <button
                            class="form__button form__button--text"
                            title="Ta ukaz počisti predpomnilnik poti, prevedenih na vaših spletnih mestih."
                        >
                            Počisti predpomnilnik poti
                        </button>
                    </form>
                </p>
                <p class="form__group form__group--horizontal">
                    <form method="POST" action="{{ url('/dashboard/commands/clear-config-cache') }}">
                        @csrf
                        <button
                            class="form__button form__button--text"
                            title="Ta ukaz počisti predpomnilnik konfiguracij, prevedenih na vaših spletnih mestih."
                        >
                            Počisti konfiguracijski predpomnilnik
                        </button>
                    </form>
                </p>
                <p class="form__group form__group--horizontal">
                    <form method="POST" action="{{ url('/dashboard/commands/clear-all-cache') }}">
                        @csrf
                        <button
                            class="form__button form__button--text"
                            title="Ta ukaz počisti VSE predpomnilnike vaših spletnih mest."
                        >
                            Počisti ves predpomnilnik
                        </button>
                    </form>
                </p>
                <p class="form__group form__group--horizontal">
                    <form method="POST" action="{{ url('/dashboard/commands/set-all-cache') }}">
                        @csrf
                        <button
                            class="form__button form__button--text"
                            title="Ta ukaz nastavi predpomnilnik VSEH vaših spletnih mest."
                        >
                            Nastavi ves predpomnilnik
                        </button>
                    </form>
                </p>
            </div>
        </section>
        <section class="panelV2">
            <h2 class="panel__heading">Email</h2>
            <div class="panel__body">
                <p class="form__group form__group--horizontal">
                    <form method="POST" action="{{ url('/dashboard/commands/test-email') }}">
                        @csrf
                        <button
                            class="form__button form__button--text"
                            title="Ta ukaz preizkusi vašo E-Mail konfiguracijo."
                        >
                            Pošlji testno E-Mail
                        </button>
                    </form>
                </p>
            </div>
        </section>
    </div>
@endsection
