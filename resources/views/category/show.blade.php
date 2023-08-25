@extends('layouts.app')

@section('template_title')
    {{ $category->name ?? "{{ __('Show') Category" }}
@endsection

@section('content')
    <h1 class="text-center">
        {{$category->getName()}}
    </h1>

    @include('layouts.filterMenu')
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    @foreach($news as $new)
                        <div class="col-sm-4">
                            @include('news._news', compact('new'))
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>


@endsection
