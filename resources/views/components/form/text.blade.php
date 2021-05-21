<div class="form-group">
    {{ Form::label($name, __('interface.fields.name')) }}
    {{ Form::text($name, $value, [
        'class' => sprintf('form-control%s', $errors->has($name) ? ' is-invalid' : null),
        ]) }}
    @error($name)
        <small class="form-text text-muted">
            <i>{{ __('interface.form.field.length.max', ['max' => $additionalProperties['max']]) }}</i>
        </small>
    @enderror
</div>
