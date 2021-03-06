@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('interface.task_statuses.index') }}</h1>
    @auth
        <a href="{{ route('task_statuses.create') }}"
           class="btn btn-primary">{{ __('buttons.task_statuses.create') }}</a>
    @endauth
    <table class="table mt-2">
        <thead>
        <tr>
            <th>{{ __('interface.fields.id') }}</th>
            <th>{{ __('interface.fields.name') }}</th>
            <th>{{ __('interface.fields.created_at') }}</th>
            @auth
                <th>{{ __('interface.fields.actions') }}</th>
            @endauth
        </tr>
        </thead>
        <tbody>
        @isset($taskStatuses)
            @foreach($taskStatuses as $taskStatus)
                <tr>
                    <td>{{ $taskStatus->id }}</td>
                    <td>{{ $taskStatus->name }}</td>
                    <td>{{ $taskStatus->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            <a href="{{ route('task_statuses.destroy', $taskStatus) }}"
                               data-confirm="{{ __('messages.confirmation') }}" data-method="delete" class="text-danger"
                               >{{ __('buttons.delete') }}</a>
                            <a href="{{ route('task_statuses.edit', $taskStatus) }}">{{ __('buttons.edit') }}</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        @endisset
        </tbody>
    </table>
@endsection
