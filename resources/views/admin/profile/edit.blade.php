@extends('layouts.adminMenu')

@section('template_title')
    {{ __('Update') }} User
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <br><div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Редагувати профіль</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.profile.update', $author->id) }}" role="form"
                              enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf

                                @include('admin.profile.form')

                        </form>

                    </div>
                </div>
                <br><div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Змінити  пароль</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.changePassword') }}" role="form"
                              enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            @csrf

                            @include('admin.profile.changePasswordForm')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
