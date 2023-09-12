@extends('layouts.app')

@section('template_title')

@endsection

@section('content')
    <h1 class="text-center">
        {{ 'Новини' }}
    </h1>

{{--    @include('layouts.filterMenu')--}}

    <div class="container">
        <br>
        <div class="row">
            <div class="col-sm-3">
                <hr>
                <h3>Стрічка новин</h3>
                <hr>
                @widget('recentNews')
            </div>
            <div class="col-sm-9">
                <div class="news row">
                    @include('news._news-full-width',['date' => ''])
                </div>
            </div>
        </div>
    </div><br>
    @if($news->hasMorePages())
        <div class="more text-center">
            <button class="btn btn-success load-more-data">Переглянути більше</button>
        </div>
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var ENDPOINT = "{{ route('allNews') }}";
        var page = 1;
        var type = '{{$_GET['type'] ?? ''}}'
        $(".load-more-data").click(function(){
            page++;
            infinteLoadMore(page);
        });

        function infinteLoadMore(page) {
            var date = $('.date-news').last().data('date');
            $.ajax({
                url: ENDPOINT + "?page=" + page,
                data:{
                    type: type,
                    date: date,
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

