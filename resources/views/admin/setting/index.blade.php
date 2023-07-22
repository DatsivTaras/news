@extends('layouts.adminMenu')

@section('template_title')
    {{ __('Create') }} Setting
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('main.Create') }} Setting</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.settings.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.setting.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
