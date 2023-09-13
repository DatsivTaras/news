@extends('layouts.app')

@section('template_title')
    {{ $category->name ?? "{{ __('Show') Category" }}
@endsection

@section('content')
    <div class="container">
        <div class="row home-content">
            <div class="col-sm-3 main-widget-left mobile-hide">
                <h3 class="main-widget-title">Стрічка новин</h3>
                @widget('recentNews')
            </div>
            <div class="col-sm-9">
                <h1 class="text-center news-category-title">
                    {{$category->getName()}}
                </h1>
                <div class="news row">
                    @include('news.parts._list-news')
                </div>
                {!! $news->links() !!}

            </div>
        </div>
    </div>


@endsection
