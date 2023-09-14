@extends('layouts.app')

@section('content')

    <div class="container mobile-hide">
        <div class="row home-content">
            <div class="col-sm-3 main-widget-left">
                <h3 class="main-widget-title">Стрічка новин</h3>
                @widget('recentNews')
            </div>
            <div class="col-sm-9 home-left-block">
                <div class="row">
                    @foreach($sliderNews as $key => $slide)
                        @if ($key == 0)
                            <div class="col-sm-12">
                                <div class="home-big-news" style="background-image: url('{{ $slide->news->getImageUrl() }}');">
                                    <a  href="{{$slide->news->getUrl()}}" style="text-decoration: none; color:black">
                                        <div class="category">
                                        <!--    <img class="card-img-top" src="{{ $slide->news->getImageUrl() }}"  width="200" height="400" alt="Card image cap" title=";ddfdf"/> -->
                                            <div class="home-big-news-category">{{ $slide->news->getCategoryName() }}</div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $slide->news->title }}</h5>
{{--                                                <p class="card-text">{{ $slide->news->mini_description }}</p>--}}
                                            </div>
                                        </div>
                                    </a>

                                    <div class="home-big-news-footer">
                                        <div class="home-big-news-footer-left"></div>
                                        <div class="home-big-news-footer-center">
                                            <a class="home-big-news-read-more" href={{ route('news') }}>Читати всі новини</a>
                                        </div>
                                        <div class="home-big-news-footer-right">
                                            <p>Джерело : {{ $slide->news->subtitle }}</p>
                                            <a class="home-big-news-read-more" href="{{$slide->news->getUrl()}}">Деталі > </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif(in_array($key, [1,2,3]))
                            <div class="col-sm-4 three-news-blocks">
                                <div class="category">
                                    <img class="card-img-top" src="{{ $slide->news->getImageUrl() }}" width="200" height="200" alt="Card image cap">
                                    <div class="three-news-blocks-category"><div class="triangle">{{ $slide->news->getCategoryName() }}</div></div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $slide->news->title }}</h5>
                                        <p class="card-text">{{ $slide->news->mini_description }}</p>
                                        <div class="read-more-container">
                                            <a href="{{$slide->news->getUrl()}}">Далі > </a>
                                            <p class="date-news">{{ \Carbon\Carbon::parse($slide->news->date_of_publication)->format('d.m.Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if ($mainBlock)
                        <div class="col-sm-12 home-right-single-news">
                            <div class="home-news-container" style="background-image: url('{{ $mainBlock->getImageUrl() }}');">
                                <div class="category">
                                    <div class="home-single-news-category"><div class="triang">{{ $mainBlock->getCategoryName() }}</div></div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $mainBlock->title }}</h5>
                                        <p class="card-text">{{ $mainBlock->getAuthor()->name }} — {{ $mainBlock->getaDate() }}</p>
                                    </div>
                                    <div class="home-single-news-footer-right">
                                        <p>Джерело: {{ $mainBlock->subtitle }}</p>
                                        <a class="home-big-news-read-more" href="{{$mainBlock->getUrl()}}">Деталі > </a>
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
                            <div class="home-two-news-category"><div class="triangl">{{ $news->category['0']->name }}</div></div>
                            <img class="card-img-top" src="{{ $news->getImageUrl() }}" width="200" height="200" alt="Card image cap">
                            <div style="background-color:coral" class="top-left"></div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $news->title }}</h5>
                                <p class="card-author-date">{{ $mainBlock->getAuthor()->name }} — {{ getDates($news->date_of_publication) }} </p>
                                <p class="card-source">Джерело: {{ $news->subtitle }}</p>
                                <a href="{{ $news->getUrl() }}" style="text-decoration: none; color:black">Деталі > </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="container desktop-hide">
            <div class="row home-content">
                <div class="col-sm-9 home-left-block">
                    <div class="row">
                        @foreach($sliderNews as $key => $slide)
                            @if ($key == 0)
                                <div class="col-sm-12">
                                    <div class="home-big-news" style="background-image: url('{{ $slide->news->getImageUrl() }}');">
                                        <a  href="{{$slide->news->getUrl()}}" style="text-decoration: none; color:black">
                                            <div class="category">
                                            <!--    <img class="card-img-top" src="{{ $slide->news->getImageUrl() }}"  width="200" height="400" alt="Card image cap" title=";ddfdf"/> -->
                                                <div class="home-big-news-category">{{ $slide->news->category['0']->name }}</div>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $slide->news->title }}</h5>
                                                    <p class="card-text">{{ $slide->news->mini_description }}</p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="home-big-news-footer">
                                            <div class="home-big-news-footer-right">
                                                <p><b>Джерело:</b> заява генерального штабу ЗСУ</p>
                                                <a class="home-big-news-read-more" href="#">Деталі > </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif(in_array($key, [1,2,3]))
                             <!--   <div class="col-sm-4 three-news-blocks">
                                    <div class="category">
                                        <img class="card-img-top" src="{{ $slide->news->getImageUrl() }}" width="200" height="200" alt="Card image cap">
                                        <div class="three-news-blocks-category"><div class="triangle">{{ $slide->news->category['0']->name }}</div></div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $slide->news->title }}</h5>
                                            <p class="card-text">{{ $slide->news->mini_description }}</p>
                                            <div class="read-more-container">
                                                <a href="{{$slide->news->getUrl()}}">Далі > </a>
                                                <p class="date-news">17.04.1992</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            @endif
                        @endforeach
                        @if ($mainBlock)
                            <div class="col-sm-12 home-right-single-news">
                                <div class="home-news-container" style="background-image: url('{{ $slide->news->getImageUrl() }}');">
                                    <div class="category">
                                        <div class="home-single-news-category"><div class="triang">{{ $mainBlock->category['0']->name }}</div></div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $mainBlock->title }}</h5>
                                            <p class="card-text">РОМАН КРАВЕЦЬ, НАЗАРІЙ МАЗИЛЮК — ЧЕТВЕР, 27 ЛИПНЯ 2023, 05:30</p>
                                        </div>
                                        <div class="home-single-news-footer-right">
                                            <p><b>Джерело:</b> заява генерального штабу ЗСУ</p>
                                            <a class="home-big-news-read-more" href="{{$slide->news->getUrl()}}">Деталі > </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 main-widget-left">
                    <h3 class="main-widget-title">Стрічка новин</h3>
                    @widget('recentNews')
                </div>
                @if ($mainBlocktwo)
                    @foreach($mainBlocktwo as $news)
                        <div class="col-sm-6 home-two-news-container">
                            <div class="category">
                                <div class="home-two-news-category"><div class="triangl">{{ $news->category['0']->name }}</div></div>
                                <img class="card-img-top" src="{{ $news->getImageUrl() }}" width="200" height="200" alt="Card image cap">
                                <div style="background-color:coral" class="top-left"></div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $news->title }}</h5>
                                    <p class="card-author-date">АЛІНА ФРОЛОВА — СЕРЕДА, 26 ЛИПНЯ 2023, 17:21</p>
                                    <p class="card-source"><b>Джерело:</b> Episode 16 • 26th July 2023 • (не)Безпечна Країна • Українська правда</p>
                                    <a href="{{ $news->getUrl() }}" style="text-decoration: none; color:black">Деталі > </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
@endsection
