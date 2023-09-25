@extends('layouts.app')

@section('op:markup_version', 'v1.0')
@section('og:title', $news->title)

@section('meta_tags')
    <meta property="op:markup_version" content="v1.0">
    <meta property="fb:article_style" content="myarticlestyle">
    <meta name="description" content="<?= $news->mini_description; ?>">
    <meta property="article:content_tier" content="free">
    <meta property="og:title" content="<?= $news->title; ?>">
    <meta property="og:description" content="<?= $news->mini_description; ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= $news->getUrl(); ?>">
    <meta name="twitter:card" content="summary_large_image">
    {{--    <meta name="twitter:site" content="@tweetsNV">--}}
    <meta name="twitter:title" content="<?= $news->title; ?>">
    <meta name="twitter:description" content="<?= $news->mini_description; ?>">
    <meta property="og:image" content="{{ $news->getImageUrl() }}">
    <meta name="twitter:image" content="{{ $news->getImageUrl() }}">
    <meta property="og:image:width" content="1920">
    <meta property="og:image:height" content="960">
    <meta name="robots" content="max-image-preview:large">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Load More Data on Button Click using JQuery Laravel - ItSolutionStuff.com</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    </head>
    <body>
@endsection

@section('template_title')
    {{ $news->getTitle() ?? "{{ __('Show')" }}
@endsection

@section('content')
    <style>
        div#social-links ul {
            display: inline-block;
        }
        div#social-links ul li {
            display: inline-block;
        }
        div#social-links ul li a {
            padding: 20px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 30px;
            color: #222;
            background-color: #ccc;
        }
    </style>
           <a href="{{ route('/') }}">< Повернутися на головну</a>
    {{ Breadcrumbs::render('news' , $news) }}

    <div class="container">
        <div class="row home-content">
            <div class="col-xl-3 col-lg-3 d-sm-none d-none d-md-none d-lg-block d-xl-block">
                <div class="main-widget-left">
                    <h3 class="main-widget-title">Стрічка новин</h3>
                    @widget('recentNews')
                </div>
            </div>

            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="row single-news-container">
                    <div class="category">
                        <img class="card-img-top" src="{{ $news->getImageUrl() }}"alt="Card image cap">
                        <div class="top-left"><div class="triangle">{{ $news->getCategoryName() }}</div></div>
                    </div>
                    <div class="singl-news-body">
                       <h1 class="single-news-title">
                            {{$news->getTitle()}}
                        </h1>
                        @if($author = $news->getAuthor())
                            <div class="row single-news-author">
                                <i>Автор: <b><a href= {{ $author->getUrl() }} }}>{{ $author->getFullName() }}</a></b></i>
                            </div><br><br>
                        @endif
                        <div class="row single-news-description">
                            {!! $news->getDescription() !!}
                        </div>
                    </div>
                    <div class="row similar-news-container">
                        @widget('SimilarNews', ['news_id' => $news->id])
                    </div>

                    <div class="row single-news-tags">
                        <div class="btn-group">
                            {{ 'Теги :' }}
                            @foreach($news->tags as $tag)
                                <div class="btn-group me-2" role="group" aria-label="Second group">
                                <a href='/search?query={{ $tag->name }}'>{{ mb_strtoupper($tag->name) . ' '}}  </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="fb-root"></div>
                    <div class="fb-comments" data-href="{{ $news->getUrl() }}" data-width="100%" data-numposts="5"></div>
                </div>
            </div>
        </div>

        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v17.0&appId= 255331274088195&autoLogAppEvents=1" nonce="znv8STtW" ></script>

        <div class="data-loader desktop-hide"></div>
    </div>

    <script>
        var ENDPOINT = "{{ route('loader-news') }}";
        var page = 1;
        var ajaxproces = false;
        var lastNewId = '{{ $news->id }}';

        $(document).ready(function(){
            $(document).on('click', '#copy-link', function(){
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val('{{ $news->getUrl() }}').select();
                document.execCommand("copy");
                $temp.remove();
                alert('Посилання успішно скопійовано у буфер обміну')
            });
        })

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                page++;
                infinteLoadMore(page);
            }
        });
        function infinteLoadMore(page) {
        if ((ajaxproces == true) || (lastNewId == 0)) {
            return ;
        }
            ajaxproces = true
            $.ajax({
                url: ENDPOINT,
                data:{
                    lastNewId: lastNewId,
                    "_token": "{{ csrf_token() }}"
                },
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
                .done(function (response) {
                    lastNewId = response['newsId'];
                    ajaxproces = false;
                    if (response.html == '') {
                        $('.auto-load').html('');
                        return;
                    }

                    $('.auto-load').hide();
                    $(".data-loader").append(response.html);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    ajaxproces = false;
                    console.log('Server error occured');
                });
        }

    </script>
@endsection

{{--        <div class="row">--}}
{{--            <div id="social-links">--}}
{{--                Поділитися:--}}
{{--                <ul>--}}
{{--                    <li>--}}
{{--                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $news->getUrl() }}" class="social-button " id="" title="" rel="">--}}
{{--                            <span class="fab fa-facebook-square"></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="https://twitter.com/intent/tweet?text=fd&amp;url={{ $news->getUrl() }}" class="social-button " id="" title="" rel="">--}}
{{--                            <span class="fab fa-twitter"></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a target="_blank" href="https://telegram.me/share/url?url={{ $news->getUrl() . '&text=' . $news->getTitle() }}" class="social-button " id="" title="" rel="">--}}
{{--                            <span class="fab fa-telegram"></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a target="_blank" href="mailto:news-demo.space?subject={{$news->getTitle() }}&amp;body={{ $news->getUrl() }}" data-provider="" data-share-link="{{ $news->getUrl() }}" data-share-title="{{ $news->getTitle() }}" class="social-button " id="" title="" rel="">--}}
{{--                            <span class="fab fa-inbox"></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="social-button" id="copy-link" title="" rel="">--}}
{{--                            <span class="fab fa-inbox"></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
