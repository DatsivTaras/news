@extends('layouts.app')

@section('template_title')

@endsection

@section('content')
    <h1 class="text-center">
        {{ 'Новини' }}
    </h1>

    @include('layouts.filterMenu')

    <div class="container">
        <br>
        <div class="row">
            <div class="col-sm-3">
                <hr>
                <h3>Стрічка новин</h3>
                <hr>
                @widget('recentNews')
            </div>
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

