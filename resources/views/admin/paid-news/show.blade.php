@extends('layouts.adminMenu')

@section('template_title')
    {{ $paidNews->name ?? "{{ __('Show') Paid News" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Paid News</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('paid-news.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>News Id:</strong>
                            {{ $paidNews->news_id }}
                        </div>
                        <div class="form-group">
                            <strong>Sort Order:</strong>
                            {{ $paidNews->sort_order }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
