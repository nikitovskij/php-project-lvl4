@extends('layouts.app')

@php
/**
 * @var \App\Models\Task $task
 */
@endphp

<div class="form-group">
    {{ Form::label('name', __('interface.fields.name')) }}
    {{ Form::text('name', $task->name, [
        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null),
        'aria-describedby' => 'taskNameHelp',
        ]) }}
    @error('name')
        <small id="taskNameHelp" class="form-text text-muted">
            <i>{{ __('interface.form.field.length.max') }}</i>
        </small>
    @enderror
</div>
