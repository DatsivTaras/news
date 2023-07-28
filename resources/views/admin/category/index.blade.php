@extends('layouts.adminMenu')

@section('template_title')
    Category
@endsection

@section('content')
    <br><div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('main.categories') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('main.CreateCategory') }}
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
                                        <th>@lang('main.OnTopMenu')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $category->name }}</td>
											<td><input data-id="{{$category->id}}" class="addItemMenu" type="checkbox" {{ !strripos($settingHeadMenu->value, $category->getUrl()) ? '' : 'checked' }}></td>
                                            <td>
                                                <form action="{{ route('admin.categories.destroy',$category->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.categories.edit',$category->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('main.Edit') }}</a>
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
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $(document).on('click', '.addItemMenu', function(){
            var id = $(this).data('id');
            var type = 'category';
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
