<?php

namespace Tests\Unit;

use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testHomeTest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
