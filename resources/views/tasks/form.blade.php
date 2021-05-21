{{ Form::bsText('name', null, null, ['max' => 255]) }}
{{ Form::bsTextArea('description') }}
{{ Form::bsSelect(['name' => 'status_id', 'label' => 'status'], $taskStatuses, null, ['placeholder' => '------']) }}
{{ Form::bsSelect(['name' => 'assigned_to_id', 'label' => 'executor'], $executors, null, ['placeholder' => '------']) }}
