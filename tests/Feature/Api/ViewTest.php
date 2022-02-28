<?php

namespace Tests\Feature\Api\Auth;

use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use UtilsTrait;

    public function teste_make_viewed_anauthorized()
    {
        $response = $this->postJson('/lessons/viewed');

        $response->assertStatus(401);
    }

    public function teste_make_viewed_error_validator()
    {
        $payload = [];

        $response = $this->postJson('/lessons/viewed', $payload, $this->defaultHeaders());

        $response->assertStatus(422);
    }
    public function teste_make_viewed_invalid_lesson()
    {
        $lesson = Lesson::factory()->create();

        $payload = ['lesson' => $lesson->id];

        $response = $this->postJson('/lessons/viewed', $payload, $this->defaultHeaders());

        $response->assertStatus(200);
    }
}
