<?php

namespace Tests\Feature\Api\Auth;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    use UtilsTrait;

    public function test_unauthenticated()
    {

        $token= $this->createTokenUser();

        $response = $this->getJson('/courses/fake_id/modules');

        $response->assertStatus(401);
    }
    public function test_get_module_course()
    {

        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200);
    }
    public function test_get_module_course_total()
    {

        $course = Course::factory()->create();
        $modules = Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

}
