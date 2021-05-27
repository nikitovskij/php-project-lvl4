 <div class="form-group">
    {{ Form::label($name, __('interface.fields.name')) }}
    {{ Form::text($name, $value, [
        'class' => sprintf('form-control%s', $errors->has($name) ? ' is-invalid' : null),
        ]) }}
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
