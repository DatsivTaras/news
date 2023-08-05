@extends('layouts.adminMenu')

@section('template_title')
    Author
@endsection

@section('content')
    <br><div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('main.authors') }}
                            </span>
                            <form action="{{ route('admin.authors.index')  }}" method="get" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                                <div class="input-group">
                                    <input name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                             <div class="float-right">
                                <a href="{{ route('admin.authors.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('main.add') }}
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
                                        <th>@lang('main.no')</th>
                                        <th>@lang('main.surname')</th>
                                        <th>@lang('main.name')</th>
                                        <th>@lang('main.patronymic')</th>
                                        <th>@lang('main.biography')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($authors as $author)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $author->surname }}</td>
											<td>{{ $author->name }}</td>
											<td>{{ $author->patronymic }}</td>
											<td>{{ $author->biography }}</td>
                                            <td>
                                                <form action="{{ route('admin.authors.destroy',$author->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('admin.authors.show',$author->id) }}"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.authors.edit',$author->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $authors->links() !!}
            </div>
        </div>
    </div>
@endsection
