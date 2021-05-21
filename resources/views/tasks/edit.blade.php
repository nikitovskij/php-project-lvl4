@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('interface.task.edit') }}</h1>
    {{ Form::model($task, [
        'url' => route('tasks.update', $task),
        'class' => 'w-50',
        'method' => 'PATCH',
        ])
    }}
    @include('tasks.form')
    {{ Form::submit(__('buttons.update'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
