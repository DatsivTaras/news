@extends('layouts.adminMenu')

@section('template_title')
    {{ $category->name ?? "{{ __('Show') Category" }}
@endsection

@section('content')
    <section class="content container-fluid" style="padding-top: 15px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">{{ $category->getName() }}</span>
                    </div>

                    <div class="card-body">
                        {{ $category->getDecription() }}
                    </div>
                </div>

                <div style="margin-top: 15px">
                    <a href="{{ route('admin.news.create', ['category_id' => $category->id]) }}" class="btn btn-primary pull-right">Додати + </a>
                </div>

                <div class="card" style="margin-top: 15px">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>@lang('main.title')</th>
                                    <th>Статус</th>
                                    <th>Слайдер</th>
                                    <th>@lang('main.type')</th>
                                    <th>@lang('main.dateOfPublication')</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($news as $key => $new)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $new->title }}</td>
                                        <td>{{ $new->getTypePublication() }}</td>
                                        <td><input data-id="{{ $new->id }}" class="addNewsSlider" type="checkbox" {{ $new->home_slider ? 'checked' : '' }} ></td>
                                        <td>{{ $new->getType() }}</td>
                                        <td>{{ $new->getPublicationDate() }}</td>
                                        <td>
                                            <form action="{{ route('admin.news.destroy', $new->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('admin.news.show', $new->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                <a class="btn btn-sm btn-success" href="{{ route('admin.news.edit', $new->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $news->links() !!}
            </div>
        </div>
    </section>
@endsection
