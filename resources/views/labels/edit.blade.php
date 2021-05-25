@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('interface.labels.edit') }}</h1>
    {{ Form::model($label, [
        'url' => route('labels.update', $label),
        'class' => 'w-50',
        'method' => 'PATCH',
        ])
    }}
    @include('labels.form')
    {{ Form::submit(__('buttons.update'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
