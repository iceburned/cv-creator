<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUniversityRequest;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        return University::all();
    }

    public function store(CreateUniversityRequest $request)
    {
        $validated = $request->validated();

        $uni = University::firstOrCreate([
            'name' => $validated['university_name'],
            'accreditation' => $validated['accreditation'],
        ]);

        return response()->noContent(201);
    }
}
