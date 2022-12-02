@extends('layout.default')

@section('title')
    <title>Klepet</title>
@endsection

@section('meta')
    <meta name="description" content="Klepet">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
       Klepet
    </li>
@endsection

@section('content')
    @if (!auth()->user()->chat_hidden)
        <div id="vue">
            <script src="{{ mix('js/chat.js') }}" crossorigin="anonymous"></script>
            <chatbox :user="{{ App\Models\User::with(['chatStatus', 'chatroom', 'group'])->find(auth()->id()) }}"></chatbox>
        </div>
    @endif
@endsection
