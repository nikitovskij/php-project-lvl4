@extends('layouts.app')

@section('content')
    <h1>
        {{ __('interface.task.show') }}: {{ $task->name }}
        <a href="{{ route('tasks.edit', $task) }}">🔧</a>
    </h1>
    <p>{{ __('interface.fields.name') }}: {{ $task->name }}</p>
    <p>{{ __('interface.fields.status') }}: {{ $task->status->name }}</p>
    <p>{{ __('interface.fields.description') }}: {{ $task->description }}</p>
@endsection
