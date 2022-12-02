@extends('layout.default')

@section('title')
    <title>{{ __('common.edit') }} Forum - {{ __('staff.staff-dashboard') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('common.edit') }} Forum - {{ __('staff.staff-dashboard') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('staff.dashboard.index') }}" class="breadcrumb__link">
            {{ __('staff.staff-dashboard') }}
        </a>
    </li>
    <li class="breadcrumbV2">
        <a href="{{ route('staff.forums.index') }}" class="breadcrumb__link">
            {{ __('staff.forums') }}
        </a>
    </li>
    <li class="breadcrumbV2">
        {{ $forum->name }}
    </li>
    <li class="breadcrumb--active">
        {{ __('common.edit') }}
    </li>
@section('page', 'page__forums-admin--edit')

@section('main')
    <section class="panelV2">
        <h2 class="panel__heading">{{ __('common.edit') }} {{ __('forum.forum') }}</h2>
        <div class="panel__body">
            <form class="form" method="POST" action="{{ route('staff.forums.update', ['id' => $forum->id]) }}">
                @csrf
                <p class="form__group">
                    <input id="title" class="form__text" type="text" name="title" value="{{ $forum->name }}">
                    <label class="form__label form__label--floating" for="title">Title</label>
                </p>
                <p class="form__group">
                    <textarea
                        id="description"
                        name="description"
                        class="form__textarea"
                    >{{ $forum->description }}</textarea>
                    <label class="form__label form__label--floating" for="description">Opis</label>
                </p>
                <p class="form__group">
                    <select name="forum_type" class="form__select">
                        @if ($forum->getCategory() == null)
                            <option value="category" selected>Kategorija (Trenutno)</option>
                            <option value="forum">Forum</option>
                        @else
                            <option value="category">Kategorija</option>
                            <option value="forum" selected>Forum (Trenutno)</option>
                        @endif
                    </select>
                    <label class="form__label form__label--floating" for="forum_type">Vrsta Foruma</label>
                </p>
                <p class="form__group">
                    <select name="parent_id" class="form__select">
                        @if ($forum->getCategory() != null)
                            <option value="{{ $forum->parent_id }}" selected>
                                {{ $forum->getCategory()->name }} (Trenutno)
                            </option>
                        @endif
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label class="form__label form__label--floating" for="parent_id">Forum za starše</label>
                </p>
                <p class="form__group">
                    <input
                        id="position"
                        class="form__text"
                        inputmode="numeric"
                        name="position"
                        pattern="[0-9]*"
                        placeholder=""
                        type="text"
                        value="{{ $forum->position }}"
                        required
                    >
                    <label class="form__label form__label--floating" for="position">
                        {{ __('common.position') }}
                    </label>
                </p>
                <p class="form__group">
                    <label class="form__label">Dovoljenja</label>
                    <div class="data-table-wrapper">
                        <table class="data-table">
                            <thead>
                            <tr>
                                <th>Skupine</th>
                                <th>Oglejte si Forum</th>
                                <th>Preberite teme</th>
                                <th>Začni novo temo</th>
                                <th>Odgovorite na teme</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $group->name }}</td>
                                    <td>
                                        <input
                                            type="checkbox"
                                            name="permissions[{{ $group->id }}][show_forum]"
                                            value="1"
                                            @checked($group->getPermissionsByForum($forum)->show_forum)
                                        />
                                    </td>
                                    <td>
                                        <input
                                            type="checkbox"
                                            name="permissions[{{ $group->id }}][read_topic]"
                                            value="1"
                                            @checked($group->getPermissionsByForum($forum)->read_topic)
                                        />
                                    </td>
                                    <td>
                                        <input
                                            type="checkbox"
                                            name="permissions[{{ $group->id }}][start_topic]"
                                            value="1"
                                            @checked($group->getPermissionsByForum($forum)->start_topic)
                                        />
                                    </td>
                                    <td>
                                        <input
                                            type="checkbox"
                                            name="permissions[{{ $group->id }}][reply_topic]"
                                            value="1"
                                            @checked($group->getPermissionsByForum($forum)->reply_topic)
                                        />
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </p>
                <p class="form__group">
                    <button class="form__button form__button--filled">
                        Shrani Forum
                    </button>
                </p>
            </form>
        </div>
    </section>
@endsection
