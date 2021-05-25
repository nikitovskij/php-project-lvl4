<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Label::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'one'],
                ['name' => 'two'],
                ['name' => 'three'],
            ))
            ->create();
    }
}
