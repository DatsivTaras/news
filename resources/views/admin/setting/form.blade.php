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

    <div class="accordion" id="accordionExample">
        @foreach($settingsCategories as $key => $settingsCategory)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{$key}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                        {{\App\Models\Setting::getSettingsCategory($key)}}
                    </button>
                </h2>
                <div id="collapse{{$key}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @foreach($settingsCategory as $setting)
                                @if($setting->type == 5)
                                    {{ Form::label('text',  $setting->name, ['class' => 'form-label']) }}
                                    {{ Form::file($setting->key, [ 'class' => 'form-control' . ($errors->has('$setting->key') ? ' is-invalid' : ''), 'onchange'=> "getImagePreview(event)", "id" => "selectImage"]) }}
                                    {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
                                    <img id="preview" width="270" height="100" src="{{ $setting->image ? Storage::url($setting->image->name) : '' }}" alt="/" class="mt-3" style="{{$setting->image ? 'display:none' : ''}}" />
                                @elseif($setting->type == 1)
                                    {{ Form::label($setting->name) }}
                                    {{ Form::text($setting->key, $setting->value, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => '' ]) }}
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                @elseif($setting->type == 2)
                                    {{ Form::label($setting->name) }}
                                    {{ Form::checkbox($setting->key, '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                @elseif($setting->type == 3)
                                    {{ Form::label($setting->name) }}
                                    {{ Form::textArea($setting->key, $setting->value, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                @elseif($setting->type == 4)
                                    {{ Form::label($setting->name) }}
                                    {{ Form::select($setting->key, json_decode($setting->params), '', ['class' => 'form-select' . ($errors->has('name') ? ' is-invalid' : '')]) }}
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                @elseif($setting->type == 6)
                                    {{ Form::label($setting->name) }}
                                    {{ Form::select($setting->key.'[]', $setting->getParams($setting->key), explode(',', $setting->value), ['class' => "form-select" . ($errors->has('name') ? ' is-invalid' : ''), 'multiple'=>'multiple']) }}
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="box-footer mt20">
        <br><button type="submit" class="btn btn-primary">{{ __('Додати') }}</button>
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

</script>
