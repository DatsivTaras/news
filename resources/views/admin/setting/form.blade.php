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
    @foreach($settings as $key => $settings)
        {{\App\Models\Setting::getSettingsCategory($key)}}
        <div class="box-body">
            @foreach($settings as $setting)
                <div class="form-group">
                    @if($setting->type == 5)
                        {{ Form::label('text',  $setting->name, ['class' => 'form-label']) }}
                        {{ Form::file($setting->key, [ 'class' => 'form-control' . ($errors->has('$setting->key') ? ' is-invalid' : ''), 'onchange'=> "getImagePreview(event)", "id" => "selectImage"]) }}
                        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
                        @elseif($setting->type == 1)
                            {{ Form::label($setting->name) }}
                            {{ Form::text($setting->key, '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        @elseif($setting->type == 2)
                            {{ Form::label($setting->name) }}
                            {{ Form::checkbox($setting->key, '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        @elseif($setting->type == 3)
                            {{ Form::label($setting->name) }}
                            {{ Form::textArea($setting->key, $setting->value, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        @elseif($setting->type == 4)
                            {{ Form::label($setting->name) }}
                            {{ Form::select($setting->key, json_decode($setting->params), '', ['class' => 'form-select' . ($errors->has('name') ? ' is-invalid' : '')]) }}
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
    <div class="box-footer mt20">
        <br><button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
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
