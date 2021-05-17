@extends('layouts.app')

@section('content')
    <h1>Задачи</h1>
    {{ $tasks->toJson() }}
@endsection
