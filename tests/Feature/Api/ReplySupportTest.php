<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplySupportTest extends TestCase
{
    use UtilsTrait;

    public function test_create_replay_supports_unauthenticated()
    {
        $response = $this->postJson('/supports/faker_id/replies');

        $response->assertStatus(401);
    }

    public function test_create_replay_supports()
    {

        $support = Support::factory()->create();

        $payload = [ 
        'description' => 'teste teste teste teste'
        ];

        $response = $this->postJson("/supports/{$support->id}/replies", $payload, $this->defaultHeaders());
        
        $response->assertStatus(201);
    }
}