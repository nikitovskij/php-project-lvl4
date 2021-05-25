<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = Label::all();

        Task::all()
            ->each(fn ($task) => $task->labels()->attach(
                $labels->random(random_int(1, 3))->pluck('id')->toArray()
            ));
    }
}
