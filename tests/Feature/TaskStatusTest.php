<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    protected TaskStatus $taskStatus;
    protected User $user;
    protected Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->taskStatus = TaskStatus::factory()->create();
        $this->user = User::factory()->create();
        $this->faker = Factory::create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $fakeStatus = $this->faker->text(20);
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), ['name' => $fakeStatus]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $fakeStatus]);
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', $this->taskStatus));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $fakeStatus = $this->faker->text(20);
        $response = $this
            ->actingAs($this->user)
            ->patch(route('task_statuses.update', $this->taskStatus), ['name' => $fakeStatus]);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('task_statuses', ['name' => $this->taskStatus->name]);
        $this->assertDatabaseHas('task_statuses', ['name' => $fakeStatus]);
    }

    public function testDelete(): void
    {
        $this->actingAs($this->user)->delete(route('task_statuses.destroy', $this->taskStatus));

        $this->assertSoftDeleted($this->taskStatus);
    }

    public function testNotAllowedDelete(): void
    {
        Task::factory()
            ->for($this->user, 'author')
            ->for($this->taskStatus, 'status')
            ->create();

        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $this->taskStatus));
        $response->assertRedirect();

        $taskStatus = TaskStatus::findOrFail($this->taskStatus->id);
        self::assertNull($taskStatus->deleted_at);
    }
}
