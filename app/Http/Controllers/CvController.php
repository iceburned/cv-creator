<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Skill;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function index()
    {
        $cvs = Cv::all();
        return view('cvs-list-view', ['cvs' => $cvs]);
    }

    public function indexView()
    {
        $universities = University::all();
        $skills = Skill::all();
        return view('cv-view', ['universities' => $universities, 'skills' => $skills]);
    }

    public function store(Request $request)
    {
        $user = User::firstOrCreate([
            'name' => $request->name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
        ]);

        $uni = University::find($request->university);

        $cv = Cv::create([
            'user_id' => $user->id,
            'accreditation' => $uni->accreditation,
            'university_id' => $uni->id,
        ]);

        $cv->skills()->attach($request->skills);

        return response()->redirectTo('/');
    }

    public function getCvPerDate(Request $request)
    {
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        return Cv::whereHas('user', function (Builder $query) use ($fromDate, $toDate) {
            return $query->where('birth_date', '>=', $fromDate)
                ->where('birth_date', '<=', $toDate);
        })
            ->with(['user', 'skills', 'university'])
            ->get();
    }
}
