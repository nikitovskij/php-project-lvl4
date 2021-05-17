@extends('layouts.app')

@section('content')
    <h1 class="mb-5">{{ __('interface.task.create') }}</h1>
    {{ Form::model($task, ['url' => route('tasks.store'), 'class' => 'w-50']) }}
    @include('tasks.form')
    {{ Form::submit(__('buttons.create'), ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection
