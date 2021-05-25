{{ Form::open(['url' => route('tasks.index'), 'class' => 'form-inline', 'method' => 'GET']) }}
{{ Form::select('filter[status_id]', $taskStatuses, $filter['status_id'] ?? null, [
    'placeholder' => __('interface.fields.status'),
    'class' => 'form-control mr-2',
    ]) }}
{{ Form::select('filter[created_by_id]', $authors, $filter['created_by_id'] ?? null, [
    'placeholder' => __('interface.fields.author'),
    'class' => 'form-control mr-2',
    ]) }}
{{ Form::select('filter[assigned_to_id]', $executors, $filter['assigned_to_id'] ?? null, [
    'placeholder' => __('interface.fields.executor'),
    'class' => 'form-control mr-2',
    ])}}
{{ Form::submit(__('buttons.apply'), ['class' => 'btn btn-outline-primary']) }}
{{ Form::close() }}

