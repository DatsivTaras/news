@extends('layouts.adminMenu')

@section('template_title')
    News
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('main.news') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('main.createNow') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
										<th>@lang('main.title')</th>
										<th>@lang('main.subtitle')</th>
                                        <th>@lang('main.miniDescription')</th>
                                        <th>@lang('main.description')</th>
                                        <th>@lang('main.typePublication')</th>
                                        <th>@lang('main.type')</th>
                                        <th>@lang('main.dateOfPublication')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $new)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $new->title }}</td>
											<td>{{ $new->subtitle }}</td>
											<td>{{ $new->mini_description }}</td>
											<td>{{ $new->description }}</td>
											<td>{{ $new->getTypePublication() }}</td>
											<td>{{ $new->getType() }}</td>
											<td>{{ $new->date_of_publication }}</td>

                                            <td>
                                                <form action="{{ route('admin.news.destroy', $new->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('admin.news.show', $new->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('main.Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.news.edit', $new->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('main.Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('main.Delete') }}</button>
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
    </div>
@endsection
