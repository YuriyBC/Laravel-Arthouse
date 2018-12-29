@extends('layouts.core')

@section('title')
    Русский Артхаус - {{$movieInfo->name}}
@endsection

@section('content')
    <div id="app"
         class="container-fluid">
        @if ($user)
            <movie-page :admin="{{$isAdmin}}"
                        :user="{{$user}}"
                        :comments="{{$comments}}"
                        :data="{{$movieInfo}}"/>
        @else
            <movie-page :admin="{{$isAdmin}}"
                        :comments="{{$comments}}"
                        :data="{{$movieInfo}}"/>
        @endif
    </div>
@endsection