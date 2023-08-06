<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label(__('main.name')) }}
            {{ Form::text('name', $category->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('main.name')]) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group>
            {{ Form::label(__('main.description')) }}
            {{ Form::textarea('description', $category->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'rows' => '3', 'placeholder' => __('main.description') ]) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <br><div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
