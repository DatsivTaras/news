@extends('layouts.adminMenu')

@section('template_title')
    {{ $tag->name ?? "{{ __('Show') Tag" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Tag</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.tags.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $tag->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
