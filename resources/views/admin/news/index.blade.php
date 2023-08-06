@extends('layouts.adminMenu')

@section('template_title')
    News
@endsection

@section('content')
    <br><div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('main.news') }}
                            </span>
                            <form action="{{ route('admin.news.index')  }}" method="get" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                                <div class="input-group">
                                    <input name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                             <div class="float-right">
                                <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>No</th>
										<th>@lang('main.title')</th>
										<th>@lang('main.subtitle')</th>
                                        <th>@lang('main.On Slider')</th>
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
											<td>{{ $new->getTypePublication() }}</td>
											<td><input  data-id="{{ $new->id }}" class="addNewsSlider" type="checkbox" {{ $new->home_slider ? 'checked' : '' }} ></td>
											<td>{{ $new->getType() }}</td>
											<td>{{ $new->date_of_publication }}</td>
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
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $(document).on('click', '.addNewsSlider', function(){
            var id = $(this).data('id');
            $.ajax({
                method: 'post',
                url: "/admin/addNewsOnSlider",
                data:{
                    id: id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
            }).done(function(result) {
                location.reload();
            });
        });
    });
</script>