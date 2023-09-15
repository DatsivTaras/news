@extends('layouts.app')

@section('content')

    <div class="container mobile-hide">
        <div class="row home-content">
            <div class="col-xl-3 col-lg-3 col-md-4 d-sm-none d-none d-md-block d-md-block">
                <div class="main-widget-left">
                    <h3 class="main-widget-title">Стрічка новин</h3>
                    @widget('recentNews')
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 home-left-block">
                <div class="row">
                    @foreach($sliderNews as $key => $slide)
                        @if ($key == 0)
                            <div class="col-sm-12">
                                <div class="home-big-news" style="background-image: url('{{ $slide->news->getImageUrl() }}');">
                                    <div>
                                        <div class="category">
                                        <!--    <img class="card-img-top" src="{{ $slide->news->getImageUrl() }}"  width="200" height="400" alt="Card image cap" title=";ddfdf"/> -->
                                            <div class="home-big-news-category"><a href={{ $slide->news->getCategory()->getUrl() }}>{{ $slide->news->getCategoryName() }}</a></div>
                                            <div class="card-body">
                                                <a href="{{$slide->news->getUrl()}}">
                                                    <span class="card-title">
                                                        {{ $slide->news->title }}
                                                    </span>
                                                </a>
{{--                                            <p class="card-text">{{ $slide->news->mini_description }}</p>--}}
                                            </div>
                                        </div>
                                    </div>

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
                        <div class="col-sm-12 home-right-single-news">
                            <div class="home-news-container" style="background-image: url('{{ $mainBlock->getImageUrl() }}');">
                                <div class="category">
                                    <div class="home-single-news-category"><div class="triang"><a href="{{ $mainBlock->getCategory()->getUrl() }}">{{ $mainBlock->getCategoryName() }}</a></div></div>
                                    <div class="card-body">
                                        <a class="home-big-news-read-more" href="{{$mainBlock->getUrl()}}">
                                            <span class="card-title">{{ $mainBlock->title }}</span>
                                        </a>
                                        <p class="card-text">{{ $mainBlock->getAuthor()->name }} — {{ $mainBlock->getaDate() }}</p>
                                    </div>
                                    <div class="home-single-news-footer-right">
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
                                <p class="card-author-date">{{ $mainBlock->getAuthor()->name }} — {{ getDates($news->date_of_publication) }} </p>
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
                                    <div class="home-big-news" style="background-image: url('{{ $slide->news->getImageUrl() }}');">
                                        <div>
                                            <div class="category">
                                            <!--    <img class="card-img-top" src="{{ $slide->news->getImageUrl() }}"  width="200" height="400" alt="Card image cap" title=";ddfdf"/> -->
                                                <div class="home-big-news-category"><a href="#">{{ $slide->news->getCategoryName() }}</a></div>
                                                <div class="card-body">
                                                    <a href="{{$slide->news->getUrl()}}">
                                                        <span class="card-title">
                                                            {{ $slide->news->title }}
                                                        </span>
                                                    </a>
    {{--                                            <p class="card-text">{{ $slide->news->mini_description }}</p>--}}
                                                </div>
                                            </div>
                                        </div>

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
                                        @widget('recentNews')
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
                                    <p class="card-source">Джерело: {{ $news->subtitle }}</p>
                                    <a class="home-two-news-read-more-btn" href="{{ $news->getUrl() }}">Деталі > </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
@endsection
