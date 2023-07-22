@extends('layouts.adminMenu')

@section('template_title')
    {{ $author->name ?? "{{ __('Show') Author" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Author</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.authors.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Surname:</strong>
                            {{ $author->surname }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $author->name }}
                        </div>
                        <div class="form-group">
                            <strong>Patronymic:</strong>
                            {{ $author->patronymic }}
                        </div>
                        <div class="form-group">
                            <strong>Biography:</strong>
                            {{ $author->biography }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
