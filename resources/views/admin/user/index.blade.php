@extends('layouts.adminMenu')

@section('template_title')
    User
@endsection

@section('content')
    <br><div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('main.User') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>@lang('main.name')</th>
										<th>@lang('main.email')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
                                            <td>
                                                <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
{{--                                                    <a class="btn btn-sm btn-primary " href="{{ route('admin.users.show',$user->id) }}"><i class="fa fa-fw fa-eye"></i></a>--}}
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.profile.edit',$user->author->id) }}"><i class="fa fa-fw fa-edit"></i></a>
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
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection
