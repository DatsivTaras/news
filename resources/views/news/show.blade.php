@extends('layouts.app')

@section('template_title')
    {{ $news->getTitle() ?? "{{ __('Show')" }}
@endsection

@section('content')

    <div class="container">
        <h1 class="text-center">
            {{$news->getTitle()}}
        </h1>
        <div class="row">
            <i>{{ $news->getPublicationDate() }}</i>
        </div>
        <div class="row">
            {!! $news->getDescription() !!}
        </div>
    </div>

@endsection
