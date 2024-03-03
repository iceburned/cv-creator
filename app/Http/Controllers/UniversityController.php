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

    public function store(Request $request)
    {
//        $validated = $request->validated();

        $user = User::firstOrCreate([
            'name' => $request->user_name,
            'middle_name' => $request->middle_name,
            'last_name' =>$request->last_name,
            'birth_date' => $request->datepicker,
        ]);

        $uni = University::firstOrCreate(['name' => $request->university_name]);
        $uni->users()->attach($user, ['scores' => $request->university_score]);
        return $uni;
    }
}
