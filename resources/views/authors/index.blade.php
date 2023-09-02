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
                                    <br><br><p class="text-muted mb-4">{{ $author->biography }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="col-sm-12">
                                        <div class="news row">
                                            @include('news._list-news')
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

        $(".load-more-data").click(function(){
            page++;
            infinteLoadMore(page);
        });

        function infinteLoadMore(page) {

            $.ajax({
                url: ENDPOINT + "?page=" + page,
                data:{
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
