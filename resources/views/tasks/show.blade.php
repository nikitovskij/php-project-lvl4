@extends('layouts.app')

@section('content')
    <h1>
        {{ __('interface.tasks.show') }}: {{ $task->name }}
        <a href="{{ route('tasks.edit', $task) }}">🔧</a>
    </h1>
    <p>{{ __('interface.fields.name') }}: {{ $task->name }}</p>
    <p>{{ __('interface.fields.status') }}: {{ $task->status->name }}</p>
    <p>{{ __('interface.fields.description') }}: {{ $task->description }}</p>
    <p>{{ __('interface.fields.labels') }}:</p>
    @if($task->labels->count() > 0)
        <ul>
            @foreach($task->labels as $taskLabel)
                <li>{{ $taskLabel->name }}</li>
            @endforeach
        </ul>
    @endif
@endsection
