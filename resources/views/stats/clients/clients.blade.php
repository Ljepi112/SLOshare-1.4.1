@extends('layout.default')

@section('title')
    <title>{{ __('stat.stats') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('stats') }}" class="breadcrumb__link">
            {{ __('stat.stats') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        Odjemalci
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="block">
            <h2>Odjemalci</h2>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Odjemalci</th>
                            <th class="text-right">{{ __('common.users') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($clients as $client => $count)
                            <tr>
                                <td class="text-success">
                                    {{ $client }}
                                </td>
                                <td>
                                    <p class="text-blue text-right">
                                        Uporablja ga {{ $count }} users(s)
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
