@extends('layouts.adminMenu')

@section('template_title')
    Page
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
    <br><div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('main.files') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('admin.files.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            <td>{{ $file->id }}</td>
                                            <td>{{ $file->name }}</td>
                                            <td>
                                                <form action="{{ route('admin.files.destroy', $file->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-default btn-sm" target="_blank" href="{{ $file->getPath() }}">Відкрити</a>
                                                    <a class="btn btn-primary btn-sm copy-link" data-path="{{ $file->getPath() }}">Копіювати посилання</a>
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
                {!! $files->links() !!}
            </div>
        </div>
    </div>
@endsection

<script>
    $(document).ready(function(){
        $(document).on('click', '.copy-link', function() {
            var $path = $(this).data('path');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($path).select();
            document.execCommand("copy");
            $temp.remove();
            alert('Посилання успішно скопійовано у буфер обміну')
        });
    })
</script>
