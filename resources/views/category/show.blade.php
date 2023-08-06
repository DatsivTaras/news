@extends('layouts.app')

@section('template_title')
    {{ $category->name ?? "{{ __('Show') Category" }}
@endsection

@section('content')

    <div class="container">
        <h1 class="text-center">
            {{$category->getName()}}
        </h1>
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    @foreach($category->news as $news)
                        <div class="col-sm-4">
                            <a href="{{$news->getUrl()}}" style="text-decoration: none; color:black">
                                <div class="card">
                                    <img class="card-img-top" src="{{ $news->getImageUrl() }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $news->title }}</h5>
                                        <p class="card-text">{{ $news->mini_description }}</p>
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
                @widget('recentNews', ['category_id' => $category->id])
            </div>
        </div>
    </div>

@endsection
