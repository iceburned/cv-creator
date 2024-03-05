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




Route::get('/', [CvController::class, 'index'])->name('home');
Route::get('/cvs', [CvController::class, 'indexView'])->name('create.cvs');
Route::post('/cvs', [CvController::class, 'store'])->name('store.cv');
Route::get('/retrieve-cvs', [CvController::class, 'getCvPerDate'])->name('get.cv.per.date');

Route::get('/skills', [SkillController::class, 'index'])->name('get.skills');
Route::post('/skills', [SkillController::class, 'store'])->name('store.skill');

Route::get('/universities', [UniversityController::class, 'index'])->name('get.universities');
Route::post('/universities', [UniversityController::class, 'store'])->name('university.store');
