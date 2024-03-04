<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCvRequest;
use App\Http\Requests\ListCvPerDateRequest;
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

    public function store(CreateCvRequest $request)
    {
        $validated = $request->validated();

        $user = User::firstOrCreate([
            'name' => $validated['name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'birth_date' => $validated['birth_date'],
        ]);

        $uni = University::find($validated['university']);

        $cv = Cv::create([
            'user_id' => $user->id,
            'university_id' => $uni->id,
        ]);

        $cv->skills()->attach($validated['skills']);

        return response()->redirectTo('/');
    }

    public function getCvPerDate(ListCvPerDateRequest $request)
    {
        $validated = $request->validated();
        $fromDate = $validated['fromDate'];
        $toDate = $validated['toDate'];

        return Cv::whereHas('user', function (Builder $query) use ($fromDate, $toDate) {
            return $query->where('birth_date', '>=', $fromDate)
                ->where('birth_date', '<=', $toDate);
        })
            ->with(['user', 'skills', 'university'])
            ->get();
    }
}
