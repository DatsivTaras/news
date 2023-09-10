@extends('layouts.app')

@section('template_title')
    {{ $category->name ?? "{{ __('Show') Category" }}
@endsection

@section('content')
    <h1 class="text-center news-category-title">
        {{$category->getName()}}
    </h1>

    <div class="container">
        <div class="row home-content">
            <div class="col-sm-3 main-widget-left">
                <h3 class="main-widget-title">Стрічка новин</h3>
                @widget('recentNews')
            </div>
            <div class="col-sm-9">
                <a href = "{{ route('category.show' , $category->slug.'?date='.\Carbon\Carbon::parse($date)->subDays(1)->format('Y-m-d'))  }}" name="dd"> <</a>
                <b>{{ \Carbon\Carbon::parse($date)->day . ' ' . \App\Helpers\DateHelper::getMonth()[\Carbon\Carbon::parse($date)->format('M')] . ' ' . \Carbon\Carbon::parse($date)->format('Y')}}</b>
                <a href = "{{ route('category.show' , $category->slug.'?date='.\Carbon\Carbon::parse($date)->addDays(1)->format('Y-m-d'))  }}" name="dd"> {{ \Carbon\Carbon::parse($date)->format('Y-m-d') >= now()->format('Y-m-d') ? '' : '>' }}</a>

                <div class="news row">
                    @include('news._list-news')
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
        var ENDPOINT = "{{ $category->getUrl() }}";
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
