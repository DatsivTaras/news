<div class="box box-info padding-1">
    <div class="box-body">


    <div class="form-group">
        {{ Form::label('Старий пароль') }}
        {{ Form::text('current_password', '', ['class' => 'form-control' . ($errors->has('current_password') ? ' is-invalid' : ''), 'placeholder' => 'Старий пароль']) }}
        {!! $errors->first('current_password', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group">
        {{ Form::label(__('main.password')) }}
        {{ Form::text('password', '', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => __('main.password')]) }}
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group">
        {{ Form::label(__('main.password_confirmation')) }}
        {{ Form::text('password_confirmation', '', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => __('main.password_confirmation')]) }}
        {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <br><div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
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
