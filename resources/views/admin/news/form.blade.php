<head>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 Tags System Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="https://cdn.tiny.cloud/1/xpu0y53v3k0hf6axlu37gm26g4ixqyidve0pfclq15j6nval/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="{{ asset("/css/css.css") }}">
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
</head>

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="mb-3">
            {{ Form::label(__('main.title')) }}
            {{ Form::text('title', $news->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => __('main.title') ]) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="mb-3">
            {{ Form::label( __('main.category')) }}
            {{ Form::select('category_id', $categories, $news->category, ['class' => 'form-select' . ($errors->has('category_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="mb-3">
            {{ Form::label('text',  __('main.image'), ['class' => 'form-label']) }}
            {{ Form::file('image', [ 'class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'onchange'=> "getImagePreview(event)", "public/image/planes/Fh2pmleVODSftbdH0gctY01sr6FH4iQHUkDXxDCd.png","id" => "selectImage"]) }}
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
            <img id="preview" width="1620" height="700" src="{{ Storage::url($image) }}" alt="/" class="mt-3" style="{{$image ? '' : 'display:none'}}"/>
        </div>
        <div class="mb-3">
            {{ Form::label( __('main.subtitle')) }}
            {{ Form::text('subtitle', $news->subtitle, ['class' => 'form-control' . ($errors->has('subtitle') ? ' is-invalid' : ''), 'placeholder' =>  __('main.subtitle')]) }}
            {!! $errors->first('subtitle', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="mb-3">
            {{ Form::label(__('main.miniDescription')) }}
            {{ Form::textarea('mini_description', $news->mini_description, ['class' => 'form-control' . ($errors->has('mini_description') ? ' is-invalid' : ''), 'rows' => '3', 'placeholder' => __('main.miniDescription') ]) }}
            {!! $errors->first('mini_description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="mb-3">
            {{ Form::label(__('main.description')) }}
            {{ Form::textarea('description', $news->description, ['class' => 'description form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => __('main.description') ]) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="mb-3">
            {{ Form::label( __('main.author')) }}
            {{ Form::select('author_id', $authors, $news->author, ['class' => 'form-select' . ($errors->has('author_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('author_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                {{ Form::label(__('main.publish')) }}
                {{ Form::radio('type_publication', 1, $news->type_publication == 1 ? true : false, ['checked' => 'checked']) }}
                {!! $errors->first('type_publication', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-check form-check-inline">
                {{ Form::label(__('main.draft')) }}
                {{ Form::radio('type_publication', 2, $news->type_publication == 2 ? true : false) }}
                {!! $errors->first('type_publication', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="form-check form-check-inline">
            {{ Form::label(__('main.simpleNews')) }}
            {{ Form::radio('type', 1, $news->type == 1 ? true : false, ['checked' => 'checked']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-check form-check-inline">
            {{ Form::label(__('main.importantNews')) }}
            {{ Form::radio('type', 2, $news->type == 2 ? true : false) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div><br><br>
        <div class="mb-3">
            {{ Form::label(__('main.dateOfPublication')) }}
            {{ Form::dateTimelocal('date_of_publication', date('Y-m-d H:i', strtotime($news->date_of_publication ? date('Y-m-d H:i', strtotime($news->date_of_publication)) : now())), ['class' => 'form-control' . ($errors->has('date_of_publication') ? ' is-invalid' : ''), 'placeholder' => 'Date Of Publication']) }}
            {!! $errors->first('date_of_publication', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="mb-3">
            {{ Form::text('tags', $tags, ['class' => 'form-control' . ($errors->has('tags') ? 'is-invalid' : ''), 'placeholder' => 'Тег...', 'data-role' => 'tagsinput']) }}
            {!! $errors->first('tags', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('main.Submit') }}</button>
    </div>
</div>

<script>
    selectImage.onchange = evt => {
        preview = document.getElementById('preview');
        preview.style.display = 'block';
        const [file] = selectImage.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }
    tinymce.init({
        selector: 'textarea.description',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
    });
</script>
