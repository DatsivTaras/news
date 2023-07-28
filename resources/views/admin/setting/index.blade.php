@extends('layouts.adminMenu')

@section('template_title')
    {{ __('Create') }} Setting
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <br><h2 class="card-title">{{ __('main.settings') }}</h2>
                <form method="POST" action="{{ route('admin.settings.store') }}"  role="form" enctype="multipart/form-data">
                    @csrf

                    @include('admin.setting.form')

                </form>
        </div>
    </section>
@endsection
