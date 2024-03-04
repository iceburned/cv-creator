<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return Skill::all();
    }

    public function store(CreateSkillRequest $request)
    {
        $validated = $request->validated();
        $skill = Skill::firstOrCreate(['name' => $validated['skill_name']]);

        return response()->noContent(201);
    }
}
