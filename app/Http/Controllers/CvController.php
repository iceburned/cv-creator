<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function index()
    {
        return Cv::all();
    }

    public function store(Request $request)
    {

        $user = User::firstOrCreate([
            'name' => $request->name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
        ]);

        $uni = University::firstOrCreate([
            'name' => $request->university,
        ]);


        $cv = Cv::create([
            'score' => $request->score,
            'user_id' => $user->id,
            'university_id' => $uni->id,
        ]);


    }
}
