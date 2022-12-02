@php $bg = rand(1, 13); $bgchange = $bg.".jpg" @endphp
<br>
<div id="l-footer" style="background-image: url('/img/footer/{{ $bgchange }}');">
    <div class="container">
        <div class="col-md-3 l-footer-section">
            <div class="banner">
                <img src="{{ url('/logo-footer.png') }}">
            </div>
            <br>
            <ul style="text-align:center;">
                <li>
                <a href="https://www.facebook.com/SLOshare" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a> |
                <a href="https://www.instagram.com/SLOshare/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a> |
                <a href="https://www.tiktok.com/@sloshare.eu/" target="_blank"><i class="fab fa-tiktok"></i> TikTok</a>
                </li>
                <br>
                <li>
                    <a href="mailto:info@sloshare.eu"><i class="{{ config('other.font-awesome') }} fa-envelope"></i> Kontaktirajte nas</a>
                </li>

            </ul>
        </div>

        <div class="col-md-2 l-footer-section">
            <h2 class="l-footer-section-title">{{ __('common.community') }}</h2>
            <ul>
                <li><a href="{{ route('forums.index') }}">{{ __('forum.forum') }}</a></li>
                @if (auth()->user()->group->is_admin)
                <li><a href="{{ route('chat') }}">{{ __('common.chat') }}</a></li>
                @endif
                <li><a href="{{ route('users') }}">{{ __('common.user-list') }}</a></li>
                @if (auth()->user()->group->is_admin)
                <li><a href="">{{ __('common.topladder') }}</a></li>
                @endif
                <li><a href="{{ route('articles.index') }}">{{ __('common.news') }}</a></li>
            </ul>
        </div>

        @if ($footer_pages)
            <div class="col-md-2 l-footer-section">
                <h2 class="l-footer-section-title">{{ __('common.support') }}</h2>
                <ul>
                    <li><a href="{{ route('faqs') }}">{{ __('page.title-faq') }}</a></li>
                    <li><a href="{{ route('policys') }}">{{ __('page.title-policy') }}</a></li>
                @if (auth()->user()->group->can_upload)
                    <li><a href="{{ route('instructions') }}">{{ __('page.title-instructions') }}</a></li>
                @endif
                @if (auth()->user()->group->is_admin)
                    <li><a href="{{ route('legals') }}">{{ __('page.title-legal') }}</a></li>
                    <li><a href="{{ route('conditionsofuses') }}">{{ __('page.title-conditionsofuse') }}</a></li>
                @endif
                </ul>
            </div>
        @endif

        <div class="col-md-2 l-footer-section">
            <h2 class="l-footer-section-title">{{ __('common.sloshare') }}</h2>
            <ul>
                <li><a href="{{ route('donationslos') }}">{{ __('common.donations') }}</a></li>
            @if (auth()->user()->group->is_admin)
                <li><a href="">{{ __('common.shop-sloshare') }}</a></li>
                <li><a href="">{{ __('common.radio-sloshare') }}</a></li>
            @endif
                <li><a href="{{ route('client_blacklist') }}">{{ __('common.blacklist') }}</a></li>
                <li><a href="{{ route('staff') }}">{{ __('common.staff') }}</a></li>
            @if (auth()->user()->group->is_admin)
                <li><a href="{{ route('about') }}">{{ __('common.about') }}</a></li>
            @endif
            </ul>
        </div>

        <div class="col-md-2 l-footer-section">
        </div>
    </div>
</div>

<div class="subfooter text-center">
    <div class="container">
        <div class="subfooter-inner">
            <div class="row">
                <div class="col-md-12">
                    <span class="text-bold">
                        <div class="text-center" style="color: #ff0000;font-size: 30px;">
                        ⚠️ Vsebina katera je na SLOshare.eu se ne sme prenalagati na druge trackerje ⚠️
                        </div>
                        <p>Poganja ga SLOshare.eu  ©2021 - {{ date('Y') }}</p>
                        <p>Upodabljanje te strani je trajalo {{ number_format(microtime(true) - (defined('LARAVEL_START') ? LARAVEL_START : request()->server('REQUEST_TIME_FLOAT')), 3) }} sekund in {{ number_format(memory_get_peak_usage(true) / 1024 / 1024, 2) }} MB pomnilnika </p>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button">
    <i class="{{ config('other.font-awesome') }} fa-arrow-square-up"></i>
</a>
<a id="back-to-down" href="#" class="btn btn-primary btn-lg back-to-down" role="button">
    <i class="{{ config('other.font-awesome') }} fa-arrow-square-down"></i>
</a>
