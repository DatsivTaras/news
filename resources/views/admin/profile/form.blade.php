<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label(__('main.name')) }}
            {{ Form::text('name', $author->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('main.name')]) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.surname')) }}
            {{ Form::text('surname', $author->surname, ['class' => 'form-control' . ($errors->has('surname') ? ' is-invalid' : ''), 'placeholder' => __('main.surname')]) }}
            {!! $errors->first('surname', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.patronymic')) }}
            {{ Form::text('patronymic', $author->patronymic, ['class' => 'form-control' . ($errors->has('patronymic') ? ' is-invalid' : ''), 'placeholder' => __('main.patronymic')]) }}
            {!! $errors->first('patronymic', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('text',  __('main.photo'), ['class' => 'form-label']) }}
            {{ Form::file('image', [ 'class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'onchange'=> "getImagePreview(event)", "public/image/planes/Fh2pmleVODSftbdH0gctY01sr6FH4iQHUkDXxDCd.png", "id" => "selectImage"]) }}
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
            <img id="preview" width="300" height="300" src="{{ $author->getImageUrl() }}" alt="/" class="mt-3" style="{{ $author->getImageUrl() ? '' : 'display:none'}}"/>
        </div>
        <div class="form-group">
            {{ Form::label(__('main.biography')) }}
            {{ Form::textarea('biography', $author->biography, ['class' => 'form-control' . ($errors->has('biography') ? ' is-invalid' : ''), 'placeholder' => __('main.biography')]) }}
            {!! $errors->first('biography', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <br><div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
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
