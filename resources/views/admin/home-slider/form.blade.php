<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('sort_order') }}
            {{ Form::text('sort_order', $homeSlider->sort_order, ['class' => 'form-control' . ($errors->has('sort_order') ? ' is-invalid' : ''), 'placeholder' => 'Sort Order']) }}
            {!! $errors->first('sort_order', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('news_id') }}
            {{ Form::text('news_id', $homeSlider->news_id, ['class' => 'form-control' . ($errors->has('news_id') ? ' is-invalid' : ''), 'placeholder' => 'News Id']) }}
            {!! $errors->first('news_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
