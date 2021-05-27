<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(TaskStatus $taskStatus, User $user, Request $request): Renderable
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->get();

        $users = $user->getUserNameList();

        return view('tasks.index', [
            'tasks' => $tasks,
            'taskStatuses' => $taskStatus->getTaskStatusesNameList(),
            'executors' => $users,
            'authors' => $users,
            'filter' => $request->get('filter'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Task $task, TaskStatus $taskStatus, User $user, Label $label): Renderable
    {
        return view('tasks.create', [
            'task' => $task,
            'taskStatuses' => $taskStatus->getTaskStatusesNameList(),
            'executors' => $user->getUserNameList(),
            'labels' => $label->getLabelNameList(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, Task $task): RedirectResponse
    {
        $task
            ->fill($request->validated())
            ->author()
            ->associate(Auth::user())
            ->save();

        $labels = $this->getLabelIds($request);

        $task->labels()->sync($labels);

        flash(__('messages.task.saved'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): Renderable
    {
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task, TaskStatus $taskStatus, User $user, Label $label): Renderable
    {
        return view('tasks.edit', [
            'task' => $task,
            'taskStatuses' => $taskStatus->getTaskStatusesNameList(),
            'executors' => $user->getUserNameList(),
            'labels' => $label->getLabelNameList(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());
        $labels = $this->getLabelIds($request);

        $task->labels()->sync($labels);

        flash(__('messages.task.updated'))->success();

        return redirect()->route('tasks.index', $task);
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

    private function getLabelIds(FormRequest $request): ?array
    {
        return array_filter($request->get('labels', []));
    }
}
