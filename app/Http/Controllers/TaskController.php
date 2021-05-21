<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(Task $task): View
    {
        return view('tasks.index', ['tasks' => $task::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Task $task, TaskStatus $taskStatus, User $user): View
    {
        return view('tasks.create', [
            'task' => $task,
            'taskStatuses' => $taskStatus->getTaskStatusesNameList(),
            'executors' => $user->getUserList(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, Task $task): RedirectResponse
    {
        $task
            ->fill($request->validated())
            ->author()
            ->associate(Auth::user())
            ->save();

        flash(__('messages.saved'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): View
    {
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, TaskStatus $taskStatus, User $user): View
    {
        return view('tasks.edit', [
            'task' => $task,
            'taskStatuses' => $taskStatus->getTaskStatusesNameList(),
            'executors' => $user->getUserList(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $taskRequest, Task $task): RedirectResponse
    {
        $task->update($taskRequest->validated());
        flash(__('messages.updated'))->success();

        return redirect()->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        flash(__('messages.task.deleted'))->success();

        return redirect()->route('tasks.index');
    }
}
