@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('interface.labels.index') }}</h1>
    @auth
        <a href="{{ route('labels.create') }}"
           class="btn btn-primary">{{ __('buttons.labels.create') }}</a>
    @endauth
    <table class="table mt-2">
        <thead>
        <tr>
            <th>{{ __('interface.fields.id') }}</th>
            <th>{{ __('interface.fields.name') }}</th>
            <th>{{ __('interface.fields.description') }}</th>
            <th>{{ __('interface.fields.created_at') }}</th>
            @auth
                <th>{{ __('interface.fields.actions') }}</th>
            @endauth
        </tr>
        </thead>
        <tbody>
        @isset($labels)
            @foreach($labels as $label)
                <tr>
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at->format('d.m.Y') }}</td>
                    @auth
                        <td>
                            <a href="{{ route('labels.destroy', $label) }}"
                               data-confirm="{{ __('messages.confirmation') }}"
                               data-method="delete"
                               class="text-danger"
                               rel="nofollow">{{ __('buttons.delete') }}</a>
                            <a href="{{ route('labels.edit', $label) }}">{{ __('buttons.edit') }}</a>
                        </td>
                    @endauth
                </tr>
            @endforeach
        @endisset
        </tbody>
    </table>
@endsection
