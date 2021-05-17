<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $statusesCollection = TaskStatus::select('id')->limit(4)->get();
        $statusesIds = $statusesCollection->map(fn ($status_id) => ['status_id' => $status_id]);

        Task::factory()
            ->count(4)
            ->state(new Sequence(...$statusesIds))
            ->create();
    }
}
