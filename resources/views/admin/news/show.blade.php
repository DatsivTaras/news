@extends('layouts.adminMenu')

@section('template_title')
    {{ $news->name ?? "{{ __('Show') News" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} News</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.news.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $news->title }}
                        </div>
                        <div class="form-group">
                            <strong>Subtitle:</strong>
                            {{ $news->subtitle }}
                        </div>
                        <div class="form-group">
                            <strong>Mini Description:</strong>
                            {{ $news->mini_description }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $news->description }}
                        </div>
                        <div class="form-group">
                            <strong>Type Publication:</strong>
                            {{ $news->type_publication }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $news->type }}
                        </div>
                        <div class="form-group">
                            <strong>Date Of Publication:</strong>
                            {{ $news->date_of_publication }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
