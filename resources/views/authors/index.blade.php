@extends('layouts.app')

@section('template_title')
@endsection

@section('content')
    <h1 align="center"> Автор </h1>
    <div class="container">
        <div class="card container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div>
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ $author->getImageUrl() }}" alt="Admin" class="rounded-circle" width="350">
                                    <div class="mt-3">
                                        <h4>{{ $author->name }}</h4>
{{--                                        <p class="text-secondary mb-1">Full Stack Developer</p>--}}
{{--                                        <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>--}}
{{--                                        <button class="btn btn-primary">Follow</button>--}}
{{--                                        <button class="btn btn-outline-primary">Message</button>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class=" mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Повне Імя</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $author->surname . '' . $author->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Біографія</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $author->biography }}
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>
        <h1 align="center"> Новини Автора </h1>
        <div class="row">
            <div class="col-sm-12">
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
        </div>
    </div><br>
    <div class="d-flex justify-content-center">
        {!! $news->links() !!}
    </div>
@endsection
