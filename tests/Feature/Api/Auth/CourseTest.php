<?php

namespace Tests\Feature\Api\Auth;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class CourseTest extends TestCase
{
   use UtilsTrait;

    public function test_unauthenticated()
    {

        $token= $this->createTokenUser();

        $response = $this->getJson('/courses');

        $response->assertStatus(401);
    }

    public function test_get_all_courses()
    {

        $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(200);
    }
    public function test_get_courses_total()
    {

        Course::factory()->count(10)->create();

        $response = $this->getJson('/courses', $this->defaultHeaders());

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }
    public function test_get_single_courses_unauthenticated()
    {

        Course::factory()->count(10)->create();

        $response = $this->getJson('/courses/fake_id',);

        $response->assertStatus(401);
    }
    public function test_get_single_courses_not_found()
    {

        Course::factory()->count(10)->create();

        $response = $this->getJson('/courses/fake_id', $this->defaultHeaders());

        $response->assertStatus(404);
    }
    public function test_get_single_courses()
    {

        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}", $this->defaultHeaders());
        $response->assertStatus(200);
    }
}
