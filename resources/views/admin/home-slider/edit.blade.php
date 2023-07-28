@extends('layouts.adminMenu')

@section('template_title')
    {{ __('Update') }} Home Slider
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <br><div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Home Slider</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('home-sliders.update', $homeSlider->id) }}" role="form"
                              enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.home-slider.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
