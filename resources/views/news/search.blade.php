@extends('layouts.app')

@section('template_title')

@endsection

@section('content')

    <div class="container">
        <div class="row home-content">
            <div class="col-xl-3 col-lg-3 col-md-4 d-sm-none d-none d-md-block d-md-block">
                <div class="main-widget-left">
                    <h3 class="main-widget-title">Стрічка новин</h3>
                    @widget('recentNews')
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('search')  }}" method="get">
                            <div class="input-group full-search-input">
                                <input name="query" value="{{ isset($_GET['query']) ? $_GET['query'] : '' }}" class="form-control"
                                       type="text" placeholder="Магате...." aria-label="Search for..."
                                       aria-describedby="btnNavbarSearch"/>
                                <button class="btn btn-primary" id="btnNavbarSearch" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                            <br>
                        </form>
                     </div>
                </div>
                <div class="news row">
                    @include('news.parts._news-search', ['type' => 1])
                </div>
            </div>
        </div>
    </div>
    @if($news->hasMorePages())
        <div class="more text-center">
            <button class="btn btn-success load-more-data">Переглянути більше</button>
        </div>
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        var ENDPOINT = "{{ route('search') }}";
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

