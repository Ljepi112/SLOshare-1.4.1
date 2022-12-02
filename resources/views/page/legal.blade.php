@extends('layout.default')

@section('title')
    <title>{{ __('page.title-legal') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('page.title-legal') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb--active">
       {{ __('page.title-legal') }}
    </li>
@endsection

@section('content')
     <div class="container box">
         <div class="col-md-12 page">
             <div class="header gradient silver">
                 <div class="inner_content">
                     <div class="page-title">
                         <h1>{{ __('page.title-legal') }}</h1>
                     </div>
                 </div>
             </div>
             <article class="page-content">
                    Stran je še v izdelavi
             </article>
         </div>
     </div>
@endsection
