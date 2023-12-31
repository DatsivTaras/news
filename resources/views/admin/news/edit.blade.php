@extends('layouts.adminMenu')

@section('template_title')
    {{ __('Update') }} News
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <br><div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('main.UpdateNews') }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.news.update', $news->id) }}" role="form"
                              enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.news.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
