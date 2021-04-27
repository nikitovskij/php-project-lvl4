<div class="form-group">
    {{ Form::label('name', __('interface.fields.name')) }}
    {{ Form::text('name', $taskStatus->name, [
        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null),
        'aria-describedby' => 'statusNameHelp',
        ]) }}
    @if(!$errors->has('name'))
        <small id="statusNameHelp" class="form-text text-muted">
            <i>{{ __('interface.form.field.length.max') }}</i>
        </small>
    @endif
</div>
