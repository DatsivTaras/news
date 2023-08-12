@extends('layouts.app')

@section('template_title')

@endsection

@section('content')

    <div class="container">
        <h1 class="text-center">
            {{ $_GET['query'] }}
        </h1>
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    @foreach($news as $new)
                        <div class="col-sm-4">
                            <a href="{{$new->getUrl()}}" style="text-decoration: none; color:black">
                                <div class="card">
                                    <img class="card-img-top" src="{{ $new->getImageUrl() }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $new->title }}</h5>
                                        <p class="card-text">{{ $new->mini_description }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-sm-3">
                <hr>
                <h3>Новини</h3>
                <hr>
                @widget('recentNews')
            </div>
        </div>
    </div>

@endsection

