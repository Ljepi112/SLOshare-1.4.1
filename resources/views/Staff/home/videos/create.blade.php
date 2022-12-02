@extends('layout.default')

@section('title')
    <title>{{ __('sloshare.home-video') }} - {{ __('staff.staff-dashboard') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('staff.dashboard.index') }}" class="breadcrumb__link">
            {{ __('staff.staff-dashboard') }}
        </a>
    </li>
    <li class="breadcrumbV2">
        <a href="{{ route('staff.homes.videos.index') }}" class="breadcrumb__link">
            {{ __('sloshare.home-video') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('common.new-adj') }}
    </li>
@endsection

@section('main')
    <section class="panelV2">
        <h2 class="panel__heading">
            {{ __('common.add') }}
        </h2>
        <div class="panel__body">
            <form
                    name="upload"
                    class="upload-form form"
                    id="upload-form"
                    method="POST"
                    action="{{ route('staff.homes.videos.store') }}"
            >
                @csrf
                <p class="form__group">
                    <input
                            type="text"
                            name="name"
                            id="name"
                            class="form__text"
                            value="{{ old('name') }}"
                            required
                    >
                    <label class="form__label form__label--floating" for="name">{{ __('common.name') }}</label>
                </p>
                <p class="form__group">
                    <input
                            type="text"
                            name="link"
                            id="link"
                            class="form__text"
                            value="{{ old('link') }}"
                    >
                    <label class="form__label form__label--floating" for="link">
                        {{ __('sloshare.link') }}
                    </label>
                </p>
                <p class="form__group">
                    <button class="form__button form__button--filled">
                        {{ __('common.submit') }}
                    </button>
                </p>
            </form>
        </div>
    </section>
@endsection