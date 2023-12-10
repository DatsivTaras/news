@extends('layouts.app')

@include('meta._tags')

@section('content')

    <div class="container mobile-hide">
        <div class="row home-content">
            <div class="col-xl-3 col-lg-3 col-md-12 d-sm-none d-none d-md-block d-md-block">
                <div class="main-widget-left">
                    <h3 class="main-widget-title">Стрічка новин</h3>
                    @widget('recentNews')
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-8 home-left-block">
                <div class="row">
                    @foreach($sliderNews as $key => $slide)
                        @if ($key == 0)
                            <div class="col-sm-12">
                                <div class="home-big-news-main-title">
                                    <div class="category">
                                        <div class="home-big-news-category">
                                            <a href={{ $slide->news->getCategory()->getUrl() }}>{{ $slide->news->getCategoryName() }}</a>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{$slide->news->getUrl()}}">
                                                    <span class="card-title">
                                                        {{ $slide->news->title }}
                                                    </span>
                                            </a>
                                            </div>
                                    </div>
                                </div>
                                <div class="home-big-news" style="background-image: url('{{ $slide->news->getImageUrl() }}');">
                                    <div class="home-big-news-footer">
                                        <div class="home-big-news-footer-right">
                                            <p><span>Джерело:</span> {{ $slide->news->subtitle }}</p>
                                            <a class="home-big-news-read-more" href="{{$slide->news->getUrl()}}">Деталі> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif(in_array($key, [1,2,3]))
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 three-news-blocks">
                                <div class="card">
                                    <div class="three-news-blocks-category">
                                        <div class="triangle">
                                            <a class="category-link" href={{ $slide->news->getCategory()->getUrl() }}>{{ $slide->news->getCategoryName() }}</a>
                                        </div>
                                    </div>
                                    <img class="card-img-top" src="{{ $slide->news->getImageUrl() }}" alt="Card image cap">
                                    <div class="card-body">
                                        <a href="{{$slide->news->getUrl()}}"><h5 class="card-title">{{ $slide->news->title }}</h5></a>
                                        <p class="card-text">{{ $slide->news->mini_description }}</p>
                                        <div class="read-more-container">
                                            <a href="{{$slide->news->getUrl()}}">
                                                <p class="read-more">Далі > </p>
                                            </a>
                                            <p class="date-news">{{ \Carbon\Carbon::parse($slide->news->date_of_publication)->format('d.m.Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>

                        @endif
                    @endforeach
                    @if ($mainBlock)
                            <div class="col-sm-12">
                                <div class="home-big-news-main-title">
                                    <div class="category">
                                        <div class="home-big-news-category">
                                            <a href="{{ $mainBlock->getCategory()->getUrl() }}">{{ $mainBlock->getCategoryName() }}</a>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{$mainBlock->getUrl()}}">
                                                <span class="card-title">
                                                    {{ $mainBlock->title }}
                                                </span>
                                                @if($author = $mainBlock->getAuthor())
                                                    <p class="card-text-author">{{ $author->getFullName() }} — {{ getDates($mainBlock->date_of_publication) }}</p>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="home-big-news" style="background-image: url('{{ $mainBlock->getImageUrl() }}'); margin-bottom: 0">
                                    <div class="home-big-news-footer">
                                        <div class="home-big-news-footer-right">
                                            <p><span>Джерело:</span> {{ $mainBlock->subtitle }}</p>
                                            <a class="home-big-news-read-more" href="{{$mainBlock->getUrl()}}">Деталі> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
            @if ($mainBlocktwo)
                @foreach($mainBlocktwo as $news)
                    <div class="col-sm-6 home-two-news-container">
                        <div class="category">
                            <div class="home-two-news-category"><div class="triangl"><a href="{{ $news->getCategory()->getUrl() }}">{{ $news->getCategoryName() }}</a></div></div>
                            <img class="card-img-top" src="{{ $news->getImageUrl() }}" width="200" height="200" alt="Card image cap">
                            <div style="background-color:coral" class="top-left"></div>
                            <div class="card-body">
                                <a class="card-title" href="{{ $news->getUrl() }}">
                                    {{ $news->title }}
                                </a>
                                @if($author = $news->getAuthor())
                                    <p class="card-author-date">{{ $author->getFullName() }} — {{ getDates($mainBlock->date_of_publication) }}</p>
                                @endif
                                <p class="card-source">Джерело: {{ $news->subtitle }}</p>
                                <a class="home-two-news-read-more-btn" href="{{ $news->getUrl() }}">Деталі > </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="container desktop-hide">
        <div class="row home-content">
            <div class="col-sm-12 home-left-block">
                <div class="row">
                    @foreach($sliderNews as $key => $slide)
                        @if ($key == 0)
                            <div class="col-sm-12">
                                <div class="home-big-news-main-title">
                                    <div class="category">
                                        <div class="home-big-news-category">
                                            <a href={{ $slide->news->getCategory()->getUrl() }}>{{ $slide->news->getCategoryName() }}</a>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{$slide->news->getUrl()}}">
                                                    <span class="card-title">
                                                        {{ $slide->news->title }}
                                                    </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="home-big-news" style="background-image: url('{{ $slide->news->getImageUrl() }}');">
                                    <div class="home-big-news-footer">
                                        <div class="home-big-news-footer-right">
                                            <p><span>Джерело:</span> {{ $slide->news->subtitle }}</p>
                                            <a class="home-big-news-read-more" href="{{$slide->news->getUrl()}}">Деталі> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                <div class="main-widget-left">
                                    <h3 class="main-widget-title">Стрічка новин</h3>
                                    @widget('recentNews', ['type' => 'mobile'])
                                </div>
                            </div>
                        @elseif(in_array($key, [1,2,3]))


                        @endif
                    @endforeach
                    @if ($mainBlock)
                    @endif
                </div>
            </div>
            @if ($mainBlocktwo)
                @foreach($mainBlocktwo as $news)
                    <div class="col-sm-6 home-two-news-container">
                        <div class="category">
                            <div class="home-two-news-category"><div class="triangl">{{ $news->category['0']->name }}</div></div>
                            <img class="card-img-top" src="{{ $news->getImageUrl() }}" width="200" height="200" alt="Card image cap">
                            <div style="background-color:coral" class="top-left"></div>
                            <div class="card-body">
                                <a class="card-title" href="{{ $news->getUrl() }}">
                                    {{ $news->title }}
                                </a>
                                <p class="card-author-date">{{ $mainBlock->getAuthor()->name }} — {{ getDates($news->date_of_publication) }} </p>
                                <p class="card-source"><b>Джерело:</b> {{ $news->subtitle }}</p>
                                <a class="home-two-news-read-more-btn" href="{{ $news->getUrl() }}">Деталі > </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
