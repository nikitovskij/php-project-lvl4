<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'task_status');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(TaskStatus $task_status): Renderable
    {
        return view('task_statuses.index', ['taskStatuses' => $task_status::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TaskStatus $task_status): Renderable
    {
        return view('task_statuses.create', ['taskStatus' => $task_status]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskStatusRequest $request, TaskStatus $task_status): RedirectResponse
    {
        $task_status
            ->fill($request->validated())
            ->save();

        flash(__('messages.task_status.saved'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $task_status): Renderable
    {
        return view('task_statuses.edit', ['taskStatus' => $task_status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskStatusRequest $request, TaskStatus $task_status): RedirectResponse
    {
        $task_status->update($request->all());

        flash(__('messages.task_status.updated'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $task_status): RedirectResponse
    {
        if ($task_status->isDeletable()) {
            $task_status->delete();

            flash(__('messages.task_status.deleted'))->success();
        } else {
            flash(__('messages.task_status.failed'))->error();
        }

        return redirect()->route('task_statuses.index');
    }
}
