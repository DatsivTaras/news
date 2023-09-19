<div class="box box-info padding-1">
    <div class="box-body">
        <input type="hidden" value="{{ $author->user->id }}" name="id">
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
            {{ Form::label(__('main.email')) }}
            {{ Form::text('email', $author->user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => __('main.email')]) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
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
        <div class="form-group">
            {{ Form::label(__('main.instagram')) }}
            {{ Form::text('instagram', $author->instagram, ['class' => 'form-control' . ($errors->has('instagram') ? ' is-invalid' : ''), 'placeholder' => __('main.instagram')]) }}
            {!! $errors->first('instagram', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.facebook')) }}
            {{ Form::text('facebook', $author->facebook, ['class' => 'form-control' . ($errors->has('facebook') ? ' is-invalid' : ''), 'placeholder' => __('main.facebook')]) }}
            {!! $errors->first('facebook', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.twitter')) }}
            {{ Form::text('twitter', $author->twitter, ['class' => 'form-control' . ($errors->has('twitter') ? ' is-invalid' : ''), 'placeholder' => __('main.twitter')]) }}
            {!! $errors->first('twitter', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.youTube')) }}
            {{ Form::text('youTube', $author->youTube, ['class' => 'form-control' . ($errors->has('youTube') ? ' is-invalid' : ''), 'placeholder' => __('main.youTube')]) }}
            {!! $errors->first('youTube', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.tikTok')) }}
            {{ Form::text('tikTok', $author->tikTok, ['class' => 'form-control' . ($errors->has('tikTok') ? ' is-invalid' : ''), 'placeholder' => __('main.tikTok')]) }}
            {!! $errors->first('tikTok', '<div class="invalid-feedback">:message</div>') !!}
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
