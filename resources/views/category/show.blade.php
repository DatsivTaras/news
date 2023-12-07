@extends('layouts.app')

@include('meta._tags', [
    'meta' => [
        'title' => $category->name,
        'description' => $category->description
    ]
])

@section('template_title')
    {{ $category->name ?? "{{ __('Show') Category" }}
@endsection

@section('content')
    <a class="back-home-btn mobile-hide" href="{{ route('/') }}"><spann class="arrow-left"></spann> Повернутися на головну</a>

    {{ Breadcrumbs::render('category' , $category) }}

    <div class="container">
        <div class="row home-content">
        <h1 class="text-center news-category-title">
            {{$category->getName()}}
        </h1>
            <div class="col-xl-3 col-lg-3 d-sm-none d-none d-md-none d-xl-block d-lg-block">
                <div class="main-widget-left">
                    <h3 class="main-widget-title">Стрічка новин</h3>
                    @widget('recentNews')
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="news row">
                    @include('news.parts._list-news')
                </div>
                {!! $news->links() !!}
            </div>
        </div>
    </div>
@endsection
