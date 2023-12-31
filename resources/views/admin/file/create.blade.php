@extends('layouts.adminMenu')

@section('template_title')
    {{ __('Create') }} File
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <br><div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Завантаження файла</span>
                    </div>
                    <div class="card-body">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('Назва файлу') }}
                                        {{ Form::text('name', '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Назва файлу' ]) }}
                                        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('Вибрати файл') }}
                                        <input type="file" name="file" accept="image/*, video/*" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Завантажити</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
