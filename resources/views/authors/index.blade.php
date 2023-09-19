@extends('layouts.app')

@section('template_title')
@endsection

@section('content')
    <div class="container">
        <div class="container py-5">
            {{--                    <div class="row">--}}
            {{--                        <div class="col">--}}
            {{--                            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">--}}
            {{--                                <ol class="breadcrumb mb-0">--}}
            {{--                                    <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
            {{--                                    <li class="breadcrumb-item"><a href="#">User</a></li>--}}
            {{--                                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>--}}
            {{--                                </ol>--}}
            {{--                            </nav>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="my-3">{{ $author->getAurhorFullName() }}</h5>
                            <img src="{{ $author->getImageUrl() }}" alt="avatar"
                                 class="img-fluid" style="width: 300px;">
                            <br><br>
                            <p class="text-muted mb-4">{{ $author->biography }}</p>
                            <footer>
                            <p class="social mt-md-3 mt-2">
                                    
                                @if($facebookLink = $author->facebook)
                                    <a href="{{ $facebookLink }}" style="text-decoration: none !important;">
                                        <span class="social-icon"><i class="fa fa-facebook" aria-hidden="true"></i></span>
                                    </a>
                                @endif

                                @if($twitterLink = $author->twitter)
                                    <a href="{{ $twitterLink }}" style="text-decoration: none !important;">
                                        <span class="social-icon"><i class="fa fa-twitter" aria-hidden="true"></i></span>
                                    </a>
                                @endif

                                @if($youtubeLink = $author->youTube)
                                    <a href="{{ $youtubeLink }}" style="text-decoration: none !important;">
                                        <span class="social-icon"><i class="fa fa-youtube" aria-hidden="true"></i></span>
                                    </a>
                                @endif

                                @if($telegramLink = $author->telegram)
                                    <a href="{{ $telegramLink }}" style="text-decoration: none !important;">
                                        <span class="social-icon"><i class="fa fa-telegram" aria-hidden="true"></i></span>
                                    </a>
                                @endif

                                @if($instagramLink = $author->instagram)
                                    <a href="{{ $instagramLink }}" style="text-decoration: none !important;">
                                        <span class="social-icon"><i class="fa fa-instagram" aria-hidden="true"></i></span>
                                    </a>
                                @endif

                                @if($tiktokLink = $author->tikTok)
                                    <a href="{{ $tiktokLink }}" style="text-decoration: none !important;">
                                        <span class="social-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                                        </span>
                                    </a>
                                @endif
                            </p>
                    </footer>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="news row">
                                    @include('news.parts._list-news')
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                @if($news->hasMorePages())
                                    <div class="more text-center">
                                        <button class="btn btn-success load-more-data">Переглянути більше</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        var ENDPOINT = "{{ $author->getUrl() }}";
        var page = 1;
        var type = '{{$_GET['type'] ?? ''}}'

        $(".load-more-data").click(function () {
            page++;
            infinteLoadMore(page);
        });

        function infinteLoadMore(page) {

            $.ajax({
                url: ENDPOINT + "?page=" + page,
                data: {
                    type: type,
                    "_token": "{{ csrf_token() }}"
                },
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
                .done(function (response) {
                    if (!response.pagin) {
                        $('.more').remove();
                    }
                    $('.auto-load').hide();
                    $(".news").append(response.html);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>
@endsection
