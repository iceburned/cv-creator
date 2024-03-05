<?php

namespace Tests\Feature;

use App\Models\Cv;
use App\Models\Skill;
use App\Models\University;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CvTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_cvs()
    {
        User::factory()->create();
        University::factory()->create();
        Cv::factory()->create();

        $response = $this->get(route('home'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('cvs-list-view')
            ->assertViewHas('cvs');
    }


    public function test_can_view_cv_creation_form()
    {
        $response = $this->get(route('create.cvs'));

        $response->assertStatus(Response::HTTP_OK)
            ->assertViewIs('cv-view')
            ->assertViewHasAll(['universities', 'skills']);
    }


    public function test_can_create_cv()
    {
        $userData = [
            'name' => 'John',
            'middle_name' => 'Doe',
            'last_name' => 'Smith',
            'birth_date' => '1990-01-01',
        ];

        $user = User::factory()->create($userData);

        $university = University::factory()->create();

        $skill1 = Skill::factory()->create();
        $skill2 = Skill::factory()->create();

        $cvData = [
            'name' => $userData['name'],
            'middle_name' => $userData['middle_name'],
            'last_name' => $userData['last_name'],
            'birth_date' => $userData['birth_date'],
            'skills' => [$skill1->id, $skill2->id],
            'university' => $university->id,
        ];

        $response = $this->post(route('store.cv'), $cvData);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/');

        $this->assertDatabaseHas('cvs', [
            'user_id' => $user->id,
            'university_id' => $university->id,
        ]);

        $this->assertDatabaseHas('cv_skills', [
            'cv_id' => Cv::first()->id,
            'skill_id' => $skill1->id,
        ]);

        $this->assertDatabaseHas('cv_skills', [
            'cv_id' => Cv::first()->id,
            'skill_id' => $skill2->id,
        ]);
    }


    public function test_can_get_cvs_per_date_range()
    {
        $fromDate = '1990-01-01';
        $toDate = '1995-12-31';

        $user1 = User::factory()->create(['birth_date' => '1992-05-15']);
        $user2 = User::factory()->create(['birth_date' => '1994-03-20']);

        $university1 = University::factory()->create();
        $university2 = University::factory()->create();

        Cv::factory()->create(['user_id' => $user1->id, 'university_id' => $university1->id]);
        Cv::factory()->create(['user_id' => $user2->id, 'university_id' => $university2->id]);

        $response = $this->get(route('get.cv.per.date', [
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]));

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(2);
    }
}
