<?php

use App\Http\Controllers\CvController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $universities = \App\Models\University::all();
    $skills = \App\Models\Skill::all();
    return view('cv-view', [ 'universities' => $universities, 'skills' => $skills]);
//    return view('cvs-list-view');
});


//Route::post('users', [UserController::class, 'store'])->name('create.user');
Route::get('/retrieve-cvs', [CvController::class, 'index']);
Route::post('/cvs', [CvController::class, 'store'])->name('store.cv');

Route::get('/skills', [SkillController::class, 'index'])->name('get.skills');
Route::post('/skills', [SkillController::class, 'store'])->name('store.skill');

Route::get('/universities', [UniversityController::class, 'index'])->name('get.universities');
Route::post('/universities', [UniversityController::class, 'store'])->name('university.store');

