@extends('layouts.adminMenu')

@section('template_title')
    User
@endsection

@section('content')
    <br><div class="main">
        <h3 align="center">Профіль</h3>
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ $author->getImageUrl() }}" alt="Admin" class="" width="400">
{{--                                    <div class="mt-3">--}}
{{--                                        <h4>John Doe</h4>--}}
{{--                                        <p class="text-secondary mb-1">Full Stack Developer</p>--}}
{{--                                        <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>--}}
{{--                                        <button class="btn btn-primary">Follow</button>--}}
{{--                                        <button class="btn btn-outline-primary">Message</button>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Прізвище</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$author->surname}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">I'мя</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$author->name}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Побатькові</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$author->patronymic}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Біографія</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$author->biography}}
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn btn-info" href='profile/{{$author->id}}/edit'>Редагувати</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

@endsection
