<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUniversityRequest;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function store(CreateUniversityRequest $request)
    {
        $validated = $request->validated();
        $uni = University::firstOrCreate(['name' => $validated['name']]);
    }
}
