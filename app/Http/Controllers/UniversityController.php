<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUniversityRequest;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        return University::all();
    }

    public function store(Request $request)
    {
//        $validated = $request->validated();
        $uni = University::firstOrCreate(['name' => $request->university_name]);


    }
}
