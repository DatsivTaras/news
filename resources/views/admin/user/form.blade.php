<div class="box box-info padding-1">
    <div class="box-body">
        <div class="mb-3">
            {{ Form::label( __('main.category')) }}
            {{ Form::select('role', $role, '', ['class' => 'form-select' . ($errors->has('role') ? ' is-invalid' : '')]) }}
            {!! $errors->first('role', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.surname')) }}
            {{ Form::text('surname', $user->surname, ['class' => 'form-control' . ($errors->has('surname') ? ' is-invalid' : ''), 'placeholder' => __('main.surname')]) }}
            {!! $errors->first('surname', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.name')) }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('main.name')]) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.patronymic')) }}
            {{ Form::text('patronymic', $user->patronymic, ['class' => 'form-control' . ($errors->has('patronymic') ? ' is-invalid' : ''), 'placeholder' => __('main.patronymic')]) }}
            {!! $errors->first('patronymic', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.email')) }}
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => __('main.email')]) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('main.biography')) }}
            {{ Form::textarea('biography', $user->email, ['class' => 'form-control' . ($errors->has('biography') ? ' is-invalid' : ''), 'placeholder' => __('main.biography')]) }}
            {!! $errors->first('biography', '<div class="invalid-feedback">:message</div>') !!}
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
    </div>
    <br><div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
