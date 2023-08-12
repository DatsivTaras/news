@extends('layouts.app')

@section('template_title')
    {{ $news->getTitle() ?? "{{ __('Show')" }}
@endsection

@section('content')

    <div class="container">
        <h1 class="text-center">
            {{$news->getTitle()}}

            <img class="card-img-top" src="{{ $news->getImageUrl() }}" width="200" height="600" alt="Card image cap">

        </h1>
        <div class="row">
            <i>{{ $news->getPublicationDate() }}</i>
        </div>
        <div class="row">
            {!! $news->getDescription() !!}
        </div>
    </div>

@endsection
