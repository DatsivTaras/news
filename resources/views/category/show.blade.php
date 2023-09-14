@extends('layouts.app')

@section('template_title')
    {{ $category->name ?? "{{ __('Show') Category" }}
@endsection

@section('content')
    <div class="container">
        <div class="row home-content">
        <h1 class="text-center news-category-title">
            {{$category->getName()}}
        </h1>
            <div class="col-xl-3 col-lg-3 col-md-4 d-sm-none d-none d-md-block d-md-block">
                <div class="main-widget-left">
                    <h3 class="main-widget-title">Стрічка новин</h3>
                    @widget('recentNews')
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12">
                <div class="news row">
                    @include('news.parts._list-news')
                </div>
                {!! $news->links() !!}
            </div>
        </div>
    </div>


@endsection
