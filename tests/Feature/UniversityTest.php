<?php

namespace Tests\Feature;

use App\Models\University;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UniversityTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_get_all_universities()
    {
        University::factory()->count(3)->create();

        $response = $this->get(route('get.universities'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(3);
    }

    public function test_can_create_university()
    {
        $universityData = [
            'university_name' => 'Test University',
            'accreditation' => 'Test Accreditation',
        ];

        $response = $this->post(route('university.store'), $universityData);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('universities', [
            'name' => 'Test University',
            'accreditation' => 'Test Accreditation',
        ]);
    }

    public function test_university_name_is_required()
    {
        $response = $this->postJson(route('university.store'), ['accreditation' => 'Test Accreditation']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors('university_name');
    }

    public function test_accreditation_is_required()
    {
        $response = $this->postJson(route('university.store'), ['university_name' => 'Test University']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors('accreditation');
    }
}
