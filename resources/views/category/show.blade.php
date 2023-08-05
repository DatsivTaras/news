@extends('layouts.app')

@section('template_title')
    {{ $category->name ?? "{{ __('Show') Category" }}
@endsection

@section('content')

    @foreach($category->news as $news)

        {{ $news->title }}
        {{ $news->subtitle }}<br><br>

    @endforeach

@endsection
