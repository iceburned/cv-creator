<?php

namespace Tests\Feature;

use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class SkillsTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_skills()
    {
        Skill::factory()->count(3)->create();

        $response = $this->get(route('get.skills'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(3);
    }

    public function test_can_create_skill()
    {
        $skillData = [
            'skill_name' => 'Test Skill',
        ];

        $response = $this->post(route('store.skill'), $skillData);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('skills', ['name' => 'Test Skill']);
    }

    public function test_skill_name_is_required()
    {
        $response = $this->postJson(route('store.skill'), []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors('skill_name');
    }
}
