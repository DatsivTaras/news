@extends('layouts.adminMenu')

@section('template_title')
    {{ __('Update') }} Page
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <br><div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('main.updatePage') }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pages.update', $page->id) }}" role="form"
                              enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.page.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
