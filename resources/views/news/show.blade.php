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
@endsection

@section('template_title')
    {{ $news->getTitle() ?? "{{ __('Show')" }}
@endsection


@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <style>
        div#social-links {
            margin: 0 auto;
            max-width: 500px;
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
        <h1 class="text-center">
            {{$news->getTitle()}}

            <img class="card-img-top" src="{{ $news->getImageUrl() }}" width="200" height="600" alt="Card image cap">

        </h1>
        <div class="row">
            <i>{{ $news->getPublicationDate() }}</i>
        </div>
        <div class="row">
            {!! $news->getDescription() !!}
        </div>
        <div class="row">
            {!! $shareComponent !!}
        </div>

    </div>

@endsection
