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

//        $user = User::firstOrCreate([
//            'name' => $validated['user_name'],
//            'middle_name' => $validated['middle_name'],
//            'last_name' =>$validated['last_name'],
//            'birth_date' => $validated['datepicker'],
//        ]);

        $uni = University::firstOrCreate([
            'name' => $validated['university_name'],
            'accreditation' => $validated['accreditation'],
//            'user_id' => $user->id,
        ]);

        return $uni;
    }
}
