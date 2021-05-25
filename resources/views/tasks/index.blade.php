@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('interface.tasks.index') }}</h1>
    <div class="d-flex">
        <div>
            @include('tasks.filter')
        </div>
        @auth
            <a href="{{ route('tasks.create') }}"
               class="btn btn-primary ml-auto">{{ __('buttons.tasks.create') }}</a>
        @endauth
    </div>
    <table class="table mt-2">
        <thead>
        <tr>
            <th>ID</th>
            <th>{{ __('interface.fields.status') }}</th>
            <th>{{ __('interface.fields.name') }}</th>
            <th>{{ __('interface.fields.author') }}</th>
            <th>{{ __('interface.fields.executor') }}</th>
            <th>{{ __('interface.fields.created_at') }}</th>
            @auth
                <th>{{ __('interface.fields.actions') }}</th>
            @endauth
        </tr>
        </thead>
        <tbody>
        @isset($tasks)
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ optional($task->status)->name }}</td>
                    <td><a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a></td>
                    <td>{{ $task->author->name }}</td>
                    <td>{{ optional($task->executor)->name }}</td>
                    <td>{{ date_format($task->created_at, 'd.m.Y') }}</td>
                    @auth
                        <td>
                            @can('delete', $task)
                                <a href="{{ route('tasks.destroy', $task) }}"
                                   data-confirm="{{ __('messages.confirmation') }}"
                                   data-method="delete"
                                   class="text-danger"
                                   rel="nofollow">{{ __('buttons.delete') }}</a>
                            @endcan
                            <a href="{{ route('tasks.edit', $task) }}">{{ __('buttons.edit') }}</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        @endisset
        </tbody>
    </table>
@endsection
