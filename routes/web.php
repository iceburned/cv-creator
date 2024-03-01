<?php

use App\Http\Controllers\CvController;
use App\Http\Controllers\SkillController;
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
//    return view('cv-view', [ 'universities' => $universities]);
    return view('cvs-list-view');
});


//Route::post('users', [UserController::class, 'store'])->name('create.user');
Route::get('/retrieve-cvs', [CvController::class, 'index']);
Route::post('/cvs', [CvController::class, 'store'])->name('store.cv');

Route::get('/skills', [SkillController::class, 'index']);
Route::post('/skills', [SkillController::class, 'store']);

