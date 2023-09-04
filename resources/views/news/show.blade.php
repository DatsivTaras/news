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
@endsection

@section('template_title')
    {{ $news->getTitle() ?? "{{ __('Show')" }}
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
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

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <hr>
                <h3>Стрічка новин</h3>
                <hr>
                @widget('recentNews')
            </div>

            <div class="col-sm-9">
                <div class="row">
                    <h1 class="text-center">
                        {{$news->getTitle()}}
                        <div class="category">
                        <img class="card-img-top" src="{{ $news->getImageUrl() }}" width="200" height="600" alt="Card image cap">
                        <div style="background-color:coral "class="top-left">{{ $news->category['0']->name }}</div>
                        </div>
                    </h1>
                    <div class="row">
                        <i>{{ $news->getPublicationDate() }}</i>
                    </div>
                    <div class="row">
                        {!! $news->getDescription() !!}
                    </div>
                    @if($author = $news->getAuthor())
                        <div class="row">
                            <div align="ceter">Автор: <a href= {{ $author->getUrl() }} }}>{{ $author->getFullName() }}</a></div>
                        </div><br><br>
                    @endif

                    <div class="row">
                        @widget('SimilarNews', ['news_id' => $news->id])
                    </div>

                    <div class="row">
                        <div class="btn-group">
                            {{ 'Теги :' }}
                            @foreach($news->tags as $tag)
                                <div class="btn-group me-2" role="group" aria-label="Second group">
                                <a href='/search?query={{ $tag->name }}'>{{ $tag->name .' '}}  </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="fb-root"></div>
                    <div class="fb-comments" data-href="{{ $news->getUrl() }}" data-width=""data-numposts="5"></div>
                </div>
            </div>
        </div>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v17.0&appId= 255331274088195&autoLogAppEvents=1" nonce="znv8STtW" ></script>
    </div>

    <script>
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
