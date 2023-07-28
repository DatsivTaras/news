@extends('layouts.adminMenu')

@section('template_title')
    {{ $homeSlider->name ?? "{{ __('Show') Home Slider" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Home Slider</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('home-sliders.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Sort Order:</strong>
                            {{ $homeSlider->sort_order }}
                        </div>
                        <div class="form-group">
                            <strong>News Id:</strong>
                            {{ $homeSlider->news_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
