<div class="form-group">
    {{ Form::label($name, __('interface.fields.description')) }}
    {{ Form::textarea($name, $value, [
        'class' => sprintf('form-control%s', $errors->has($name) ? ' is-invalid' : null),
        'cols' => 50,
        'rows' => 10,
        'spellcheck' => false,
        ]) }}
</div>
