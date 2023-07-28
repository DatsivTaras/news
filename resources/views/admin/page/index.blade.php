@extends('layouts.adminMenu')

@section('template_title')
    Page
@endsection

@section('content')
    <br><div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('main.pages') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('main.CreatePage') }}
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
										<th>@lang('main.title')</th>
										<th>@lang('main.description')</th>
                                        <th>@lang('main.OnTopMenu')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $page->title }}</td>
											<td>{{ $page->description }}</td>
                                            <td><input data-id="{{ $page->id }}" class="addItemMenu" type="checkbox" {{ !strripos($settingHeadMenu->value, $page->getUrl()) ? '' : 'checked' }}></td>
                                            <td>
                                                <form action="{{ route('admin.pages.destroy',$page->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('admin.pages.show',$page->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('main.Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.pages.edit',$page->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('main.Edit') }}</a>
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
                {!! $pages->links() !!}
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $(document).on('click', '.addItemMenu', function(){
            var id = $(this).data('id');
            var type = 'page';
            $.ajax({
                method: 'post',
                url: "/admin/addItemsSettings",
                data:{
                    id: id,
                    type: type,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
            }).done(function(result) {
                console.log(result);
            });
        });
    });
</script>
