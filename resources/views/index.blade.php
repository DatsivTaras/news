@extends('layouts.app')

@section('content')
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
                    @foreach($sliderNews as $key => $slide)
                        @if ($key == 0)
                            <div class="col-sm-12" style="margin-bottom: 15px">
                                <a href="{{$slide->news->getUrl()}}" style="text-decoration: none; color:black">
                                    <div class="card">
                                        <img class="card-img-top" src="/{{ $slide->news->getImageUrl() }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $slide->news->title }}</h5>
                                            <p class="card-text">{{ $slide->news->mini_description }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @elseif(in_array($key, [1,2,3]))
                            <div class="col-sm-4">
                                <a href="{{$slide->news->getUrl()}}" style="text-decoration: none; color:black">
                                    <div class="card">
                                        <img class="card-img-top" src="/{{ $slide->news->getImageUrl() }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $slide->news->title }}</h5>
                                            <p class="card-text">{{ $slide->news->mini_description }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
