@extends('layouts.core')

@section('title')
    Русский Артхаус
@endsection

@section('content')
    <div id="app" class="container-fluid">
        @if ($user and $data)
            <home-page :user="{{$user}}"
                       :admin="{{$isAdmin}}"
                       :data="{{$data}}" />
        @endif

        @if (!$user)
            <home-page :data="{{$data}}" />
        @endif

    </div>
@endsection