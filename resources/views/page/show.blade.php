@extends('layouts.app')

@section('template_title')
    {{ $page->name ?? "{{ __('Show') Page" }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="text-align: center">{{ $page->title }}</h1>
            </div>
            <div class="col-md-12">
                {!! $page->description !!}
            </div>
        </div>
    </div>
@endsection
