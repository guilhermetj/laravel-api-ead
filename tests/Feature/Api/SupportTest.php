<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use App\Models\Support;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use UtilsTrait;

    public function test_my_supports_unauthenticated()
    {
        $response = $this->getJson('/my-supports');

        $response->assertStatus(401);
    }
    public function test_supports_unauthenticated()
    {
        $response = $this->getJson('/supports');

        $response->assertStatus(401);
    }
    public function test_create_supports_unauthenticated()
    {
        $response = $this->postJson('/supports');

        $response->assertStatus(401);
    }
        
    public function test_get_my_supports()
    {

        $user = $this->createUser();
        $token= $user->createToken('teste')->plainTextToken;


        Support::factory()->count(50)->create([   //50 supports para o usuario
            'user_id' => $user->id,
        ]);
        Support::factory()->count(60)->create(); //50 supports para usuarios randons 

        $response = $this->getJson('/my-supports', [
            'Authorization' => "Bearer {$token}"
        ]);
        
        $response->assertStatus(200);
    }
    public function test_get_supports()
    {
        Support::factory()->count(50)->create();

        $response = $this->getJson('/supports', $this->defaultHeaders());
        
        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }
    public function test_get_supports_filter_lesson()
    {
        $lesson = Support::factory()->create();

        Support::factory()->count(50)->create();
        Support::factory()->count(10)->create([
            'lesson_id' => $lesson->id,
        ]);

        $payloads = ['lesson' => $lesson->id];

        $response = $this->Json('GET','/supports',$payloads, $this->defaultHeaders());
        
        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }
    public function test_create_supports()
    {
        $lesson = Lesson::factory()->create();

        $payload = [ 
        'lesson' => $lesson->id,
        'status' => 'P',
        'description' => 'teste teste teste teste'
        ];

        $response = $this->postJson('/supports', $payload, $this->defaultHeaders());
        
        $response->assertStatus(201);
    }

}
