<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class LessonsTest extends TestCase
{
    use UtilsTrait;

    public function test_unauthenticated()
    {

        $response = $this->getJson('/courses/fake_id/modules');

        $response->assertStatus(401);
    }
    public function test_get_lessons_module_total()
    {

        $modules = Module::factory()->create();
        Lesson::factory()->count(10)->create([
            'module_id' => $modules->id
        ]);

        $response = $this->getJson("/modules/{$modules->id}/lessons", $this->defaultHeaders());
        $response->assertStatus(200);
    }

    public function test_get_single_lessons_not_found()
    {

        $response = $this->getJson("/lessons/fake_value", $this->defaultHeaders());
        $response->assertStatus(404);
    }
    
    public function test_get_single_lessons()
    {
        $lesson =  Lesson::factory()->create();
        $response = $this->getJson("/lessons/$lesson->id", $this->defaultHeaders());
        $response->assertStatus(200);
    }

    
}
