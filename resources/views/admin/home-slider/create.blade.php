@extends('layouts.adminMenu')

@section('template_title')
    {{ __('Create') }} Home Slider
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <br><div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Home Slider</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('home-sliders.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('home-slider.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
