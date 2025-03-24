<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;
use App\Models\School;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ClerkController;
// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SectionalController;


Route::get('/teacher/{id}/qrcode', [TeacherController::class, 'showQRCode'])->name('teacher.qrcode');



Route::get('/registerschool', action: [SchoolController::class, "index"])->name(name: 'zonal.registerschool');

Route::post('/registerschool', [SchoolController::class, "store"])->name('school.store');
// Route::get('/register', function () {
//     dd('post request here');
// });

Route::get('/zonalDashboard', function () {
    return view('zonal.zonalDashboard');
});

Route::get('/principalDashboard', function () {
    return view('principal.principalDashboard');
})->name('principaldashboard');


Route::get('/schoolDashboard', function () {
    if (!session('school_id')) {
        return redirect('/')->with('error', 'Unauthorized access.');
    }

    return view('school.schoolDashboard');
});

Route::get('/registerZonal', action: [ZonalController::class, "index"])->name(name: 'registerZonal');

Route::post('/registerZonal', [ZonalController::class, "store"])->name('zonal.store');



Route::get('/registerTeacher', action: [TeacherController::class, "index"])->name(name: 'school.registerTeacher');

Route::post('/registerTeacher', [TeacherController::class, "store"])->name('teacher.store');

Route::get('/registerSectionhead', action: [SectionalController::class, "index"])->name(name: 'school.registerSectionhead');

Route::post('/registerSectionhead', [SectionalController::class, "store"])->name('sectionhead.store');

Route::get('/registerPrincipal', action: [PrincipalController::class, "index"])->name(name: 'school.registerPrincipal');

Route::post('/registerPrincipal', [PrincipalController::class, "store"])->name('principal.store');

Route::get('/registerClerk', action: [ClerkController::class, "index"])->name(name: 'school.registerClerk');

Route::post('/registerClerk', [ClerkController::class, "store"])->name('clerk.store');

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/principalDashboard', fn() => view('principal.principalDashboard'));
    Route::get('/teacherDashboard', fn() => view('teacher.teacherDashboard'));
    Route::get('/clerkDashboard', fn() => view('clerk.clerkDashboard'));
    Route::get('/schoolDashboard', fn() => view('school.schoolDashboard'));
    Route::get('/zonalDashboard', fn() => view('zonal.zonalDashboard'));
    Route::get('/sectionalDashboard', fn() => view('sectional_head.sectionalDashboard'));
});



Route::get('/scan-qr', function () {
    return view('clerk.scan_qr');
});

Route::get('/teacher/log-attendance/{id}', [TeacherController::class, 'logAttendance']);
// Route::get('/teacher/log-attendance/{id}', [AttendanceController::class, 'logAttendance']);

// Route::get('/teacher/scan', function () {
//     return view('scan'); // Assuming your blade file is named `scan.blade.php`
// })->name('teacher.scan');
Route::get('/scan', function () {
    return view('clerk.scan');
})->name('qr.scan');

// Route::get('/attendanceReport', action: [PrincipalController::class, "index"])->name(name: 'school.registerPrincipal');
Route::get('/attendanceReport', function () {
    return view('principal.attendanceReport');
});


// Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');