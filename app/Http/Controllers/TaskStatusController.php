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
    public function index(TaskStatus $taskStatus): Renderable
    {
        return view('task_statuses.index', ['taskStatuses' => $taskStatus::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TaskStatus $taskStatus): Renderable
    {
        return view('task_statuses.create', ['taskStatus' => $taskStatus]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus
            ->fill($request->validated())
            ->save();

        flash(__('messages.saved'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus): Renderable
    {
        return view('task_statuses.edit', ['taskStatus' => $taskStatus]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->update($request->all());

        flash(__('messages.updated'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->isDeletable()) {
            $taskStatus->delete();

            flash(__('messages.task_status.deleted'))->success();
        } else {
            flash(__('messages.task_status.failed'))->error();
        }

        return redirect()->route('task_statuses.index');
    }
}
