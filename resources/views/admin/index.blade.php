@extends('layouts.adminMenu')

@section('content')
    <div class="container-fluid" style="padding-top: 15px">

{{--        <div class="card text-center">--}}
{{--            <div class="card-header">--}}
{{--                Аналітика--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <h5 class="card-title">В розробці</h5>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row" style="margin-top:20px">

            @foreach ($categories as $category)

                <div class="col-sm-6">
                    <div class="card" style="margin-top:10px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->getName() }}</h5>
                            <p class="card-text">{{ $category->getShortDescription() }}</p>
                            <a href="{{ $category->getAdminUrl() }}" class="btn btn-primary">Перейти</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection()
