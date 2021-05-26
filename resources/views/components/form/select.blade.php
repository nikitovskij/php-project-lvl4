<div class="form-group">
    {{ Form::label($params['name'], __(sprintf('interface.fields.%s', $params['label']))) }}
    {{ Form::select($params['name'], $list, $value, array_merge([
        'class' => sprintf('form-control%s', $errors->has($params['name']) ? ' is-invalid' : null),
        ], $attributes)) }}
    @error($params['name'])
    <small class="form-text text-muted">
        <i>{{ $message }}</i>
    </small>
    @enderror
</div>
