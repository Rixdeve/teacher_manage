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
use App\Models\Attendance;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZonalController;



Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


Route::get('/teacher/{id}/qrcode', [TeacherController::class, 'showQRCode'])->name('teacher.qrcode');



Route::get('/registerschool', action: [SchoolController::class, "index"])->name(name: 'zonal.registerschool');

Route::post('/registerschool', [SchoolController::class, "store"])->name('school.store');
// Route::get('/register', function () {
//     dd('post request here');
// });

Route::get('/zonalDashboard', function () {
    return view('zonal.zonalDashboard');
});



Route::get('/principalDashboard', [PrincipalController::class, 'dashboardview'])->name('principal.principalDashboard');



Route::get('/clerkDashbord', function () {
    return view('clerk.clerkDashboard');
});

// Route::get('/clerkDashboard', [AttendanceController::class, 'dashboardView'])->name('clerk.dashboard');
// Route::get('/sectionheadDashboard', [TeacherController::class, 'dashboardview'])->name('sectional_head.sectionheadDashboard');

Route::get('/liveAttendance', [SectionalController::class, 'liveAttendanceView'])->name('sectional_head.liveAttendance');


Route::get('/schoolDashboard', function () {
    if (!session('school_id')) {
        return redirect('/')->with('error', 'Unauthorized access.');
    }

    return view('school.schoolDashboard');
});

// // Route::get('/registerZonal', action: [ZonalController::class, "index"])->name(name: 'registerZonal');

// // Route::post('/registerZonal', [ZonalController::class, "store"])->name('zonal.store');
// // Route::get('/manualAttendance', [AttendanceController::class, 'lookup'])->name('attendance.lookup');

// // GET: Show form to search and edit a user's attendance by date


// // Show the form (GET)
// Route::get('/manualAttendance', [AttendanceController::class, 'showManualEntry'])->name('clerk.manualAttendance');

// // Handle the submitted form (POST)
// Route::post('/manualAttendance', [AttendanceController::class, 'store'])->name('attendance.store');

Route::get('/my_attendance', [AttendanceController::class, 'myAttendance'])->name('attendance.index');


Route::get('/absenteesprin', [PrincipalController::class, 'liveAbsentees'])->name('principal.absentee');
Route::get('/absenteesclerk', [ClerkController::class, 'liveAbsentees'])->name('clerk.absenteesclerk');
Route::get('/absenteessection', [ClerkController::class, 'liveAbsentees'])->name('clerk.absenteessection');

Route::get('/liveAttendanceclerk', [ClerkController::class, 'liveAttendanceView'])->name('clerk.liveAttendanceclerk');
Route::get('/liveAttendanceprin', [PrincipalController::class, 'liveAttendanceView'])->name('principal.liveAttendanceprin');



Route::get('/manualAttendance', [AttendanceController::class, 'showManualEntry'])->name('clerk.manualAttendance');
Route::post('/manualAttendance', [AttendanceController::class, 'store'])->name('attendance.store');

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
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     });
// });

Route::get('/registerZonal', [ZonalController::class, 'index'])->name('registerZonal');
Route::post('/registerZonal', [ZonalController::class, 'store'])->name('zone.store');




Route::get('/principalDashboard', fn() => view('principal.principalDashboard'));
Route::get('/teacherDashboard', fn() => view('teacher.teacherDashboard'));
Route::get('/clerkDashboard', fn() => view('clerk.clerkDashboard'));
// Route::get('/schoolDashboard', fn() => view('school.schoolDashboard'));
Route::get('/zonalDashboard', fn() => view('zonal.zonalDashboard'));
Route::get('/schoolDashboard', [SchoolController::class, 'schoolDashboard'])->name('school.dashboard');

Route::get('/sectionheadDashboard', fn() => view('sectional_head.sectionheadDashboard'));



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

Route::get('/attendanceReport', action: [PrincipalController::class, "showAttendanceTable"])->name(name: 'attendance.Report');

Route::get('/show', [ProfileController::class, 'show'])->name('profile.show');
// Route::get('/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('password.change');
// Route::post('/change-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
Route::get('/change-password', function () {
    return view('profile.change-password');
})->name('password.change');

Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('password.update');

// Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



use App\Http\Controllers\LeaveApplicationController;

Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
Route::post('/leave/store', [LeaveApplicationController::class, 'store'])->name('leave.store');
Route::get('/leave/index', [LeaveApplicationController::class, 'index'])->name('leave.index');
Route::patch('/leave/{leaveId}/status', [LeaveApplicationController::class, 'updateStatus'])->name('leave.updateStatus');





// Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
// Route::post('/leave/store', [LeaveApplicationController::class, 'store'])->name('leave.store');

// Principal routes
Route::get('/principal/dashboard', [PrincipalController::class, 'dashboard'])->name('principal.dashboard');
Route::patch('/leave/{id}/status', [PrincipalController::class, 'updateLeaveStatus'])->name('leave.updateStatus');

// Other Principal routes
Route::get('/registerPrincipal', [PrincipalController::class, 'index'])->name('principal.register');
Route::post('/registerPrincipal', [PrincipalController::class, 'store'])->name('principal.store');
Route::get('/principal/qrcode/{id}', [PrincipalController::class, 'showQRCode'])->name('principal.qrcode');
Route::get('/principal/log-attendance/{id}', [PrincipalController::class, 'logAttendance'])->name('principal.logAttendance');
Route::get('/principal/dashboardview', [PrincipalController::class, 'dashboardview'])->name('principal.dashboardview');
Route::get('/principal/attendance-report', [PrincipalController::class, 'showAttendanceTable'])->name('principal.attendanceReport');
Route::get('/principal/absentees', [PrincipalController::class, 'liveAbsentees'])->name('principal.absentees');
Route::get('/principal/live-attendance', [PrincipalController::class, 'liveAttendanceView'])->name('principal.liveAttendance');


Route::get('/teacher/leave-history', [LeaveApplicationController::class, 'history'])->name('leave.history');



Route::middleware(['auth'])->group(function () {
    Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
    Route::post('/leave', [LeaveApplicationController::class, 'store'])->name('leave.store');
    Route::get('/leave', [LeaveApplicationController::class, 'index'])->name('leave.index');
    Route::patch('/leave/{leaveId}/status', [LeaveApplicationController::class, 'updateStatus'])->name('leave.updateStatus');
});

Route::get('/leave/record', [LeaveApplicationController::class, 'schoolLeaveRecord'])->name('leave.record');


Route::get('/leave/history', [LeaveApplicationController::class, 'history'])->name('leave.history')->middleware('auth');


Route::get('/leave/record', [LeaveApplicationController::class, 'record'])->name('leave.record')->middleware('auth');



//sec
// Leave-related routes
Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
Route::post('/leave', [LeaveApplicationController::class, 'store'])->name('leave.store');
Route::get('/leave', [LeaveApplicationController::class, 'index'])->name('leave.index');
Route::get('/leave/record', [LeaveApplicationController::class, 'record'])->name('leave.record');
Route::get('/leave/history', [LeaveApplicationController::class, 'history'])->name('leave.history');
Route::post('/leave/{leaveId}/status', [LeaveApplicationController::class, 'updateStatus'])->name('leave.updateStatus');




Route::middleware('auth')->group(function () {
    Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
    Route::post('/leave', [LeaveApplicationController::class, 'store'])->name('leave.store');
    Route::get('/leave', [LeaveApplicationController::class, 'index'])->name('leave.index');
    Route::post('/leave/{leaveId}/status', [LeaveApplicationController::class, 'updateStatus'])->name('leave.updateStatus');
    Route::get('/leave/history', [LeaveApplicationController::class, 'history'])->name('leave.history');
    Route::get('/leave/record', [LeaveApplicationController::class, 'record'])->name('leave.record');
});
