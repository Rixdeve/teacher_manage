<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;
use App\Models\School;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/registerschool', action: [SchoolController::class, "index"])->name(name: 'registerschool');

Route::post('/registerschool', [SchoolController::class, "store"])->name('school.store');
// Route::get('/register', function () {
//     dd('post request here');
// });

Route::get('/zonalDashboard', function () {
    return view('zonalDashboard');
});

Route::get('/schoollDashboard', function () {
    return view('schoollDashboard');
});

Route::get('/registerTeacher', action: [TeacherController::class, "index"])->name(name: 'registerTeacher');

Route::post('/registerTeacher', [TeacherController::class, "store"])->name('teacher.store');

Route::get('/login', function () {
    return view('login');
});