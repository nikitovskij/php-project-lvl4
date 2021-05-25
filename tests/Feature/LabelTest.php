<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    private Label $label;
    private User $user;
    private Generator $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->label = Label::factory()->create();
        $this->user = User::factory()->create();
        $this->faker = Factory::create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));

        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));

        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $fakeLabelName = $this->faker->text(20);
        $fakeLabelDescription = $this->faker->text();
        $response = $this->actingAs($this->user)
            ->post(route('labels.store'), [
                'name' => $fakeLabelName,
                'description' => $fakeLabelDescription,
            ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', ['name' => $fakeLabelName, 'description' => $fakeLabelDescription]);
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.edit', $this->label));

        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        $fakeLabelName = $this->faker->text(20);
        $response = $this
            ->actingAs($this->user)
            ->patch(route('labels.update', $this->label), ['name' => $fakeLabelName]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('labels', ['name' => $this->label]);
        $this->assertDatabaseHas('labels', ['name' => $fakeLabelName]);
    }

    public function testDelete(): void
    {
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $this->label));

        $response->assertRedirect();
        $this->assertSoftDeleted($this->label);
    }
}
