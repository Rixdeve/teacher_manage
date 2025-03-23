<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;
use App\Models\School;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;


Route::get('/teacher/{id}/qrcode', [TeacherController::class, 'showQRCode'])->name('teacher.qrcode');




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


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/principalDashboard', fn() => view('principalDashboard'));
    Route::get('/teacherDashboard', fn() => view('teacherDashboard'));
    Route::get('/clerkDashboard', fn() => view('clerkDashboard'));
    Route::get('/schoolDashboard', fn() => view('schoolDashboard'));
    Route::get('/zonalDashboard', fn() => view('zonalDashboard'));
    Route::get('/sectionalDashboard', fn() => view('sectionalDashboard'));
});



Route::get('/scan-qr', function () {
    return view('teachers.scan_qr');
});

Route::get('/teacher/log-attendance/{id}', [TeacherController::class, 'logAttendance']);
// Route::get('/teacher/log-attendance/{id}', [AttendanceController::class, 'logAttendance']);

// Route::get('/teacher/scan', function () {
//     return view('scan'); // Assuming your blade file is named `scan.blade.php`
// })->name('teacher.scan');
Route::get('/scan', function () {
    return view('scan');
})->name('qr.scan');
