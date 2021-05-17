<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected Task $task;
    protected User $user;
    protected TaskStatus $taskStatus;
    protected Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->task = Task::findOrFail(1);
        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatus::findOrFail(1);
        $this->faker = Factory::create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $fakeTask = $this->faker->text(20);
        $response = $this->actingAs($this->user)->post(route('tasks.store'), ['name' => $fakeTask]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', ['name' => $fakeTask]);
    }

    public function testShow(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.show', $this->task));
        $response->assertStatus(200);
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $this->task));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $fakeTask = $this->faker->text(20);
        $response = $this
            ->actingAs($this->user)
            ->patch(route('tasks.update', $this->task), ['name' => $fakeTask]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('tasks', ['name' => $this->task->name]);
        $this->assertDatabaseHas('tasks', ['name' => $fakeTask]);
    }

    public function testDelete(): void
    {
        $this->actingAs($this->user)->delete(route('tasks.destroy', $this->task));
        $this->assertSoftDeleted('tasks', ['id' => $this->task->id]);
    }
}
