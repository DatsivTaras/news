@extends('layouts.app')

@section('template_title')

@endsection

@section('content')

    @include('layouts.filterMenu')

    <div class="container">
        <br>
        <div class="row">
            <form action="{{ route('search')  }}" method="get" style="float: right">
                <div class="input-group">
                    <input name="query" value="{{ isset($_GET['query']) ? $_GET['query'] : '' }}" class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div><br>
            </form>
            <div class="col-sm-9">
                <div class="row">
                    @foreach($news as $new)
                        <div class="col-sm-4">
                            @include('news._news', compact('new'))
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

