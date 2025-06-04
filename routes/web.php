<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TeacherController;
use App\Models\School;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ClerkController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\LeaveApplicationController;

use App\Http\Controllers\SectionalController;
use App\Models\Attendance;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZonalController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\PrincipalMiddleware;
use App\Http\Middleware\ZonalMiddleware;
use App\Http\Middleware\SectionMiddleware;
use App\Http\Middleware\SchoolMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Middleware\ClerkMiddleware;




Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


    // Route::get('/teacher/{id}/qrcode', [ProfileController::class, 'showQRCode'])->name('teacher.qrcode');
    Route::get('/profile.show', [ProfileController::class, 'showQRCode'])->name('my.qrcode');




    // Route::get('/register', function () {
    //     dd('post request here');
    // });








    // Route::get('/clerkDashboard', [AttendanceController::class, 'dashboardView'])->name('clerk.dashboard');
    // Route::get('/sectionheadDashboard', [TeacherController::class, 'dashboardview'])->name('sectional_head.sectionheadDashboard');

    Route::get('/liveAttendance', [SectionalController::class, 'liveAttendanceView'])->name('sectional_head.liveAttendance');



    // // Route::get('/registerZonal', action: [ZonalController::class, "index"])->name(name: 'registerZonal');

    // // Route::post('/registerZonal', [ZonalController::class, "store"])->name('zonal.store');
    // // Route::get('/manualAttendance', [AttendanceController::class, 'lookup'])->name('attendance.lookup');

    // // GET: Show form to search and edit a user's attendance by date


    // // Show the form (GET)
    // Route::get('/manualAttendance', [AttendanceController::class, 'showManualEntry'])->name('clerk.manualAttendance');

    // // Handle the submitted form (POST)
    // Route::post('/manualAttendance', [AttendanceController::class, 'store'])->name('attendance.store');

    Route::get('/my_attendance', [AttendanceController::class, 'myAttendance'])->name('attendance.index');




    // Route::get('/absenteessection', [SectionalController::class, 'liveAbsentees'])->name('sectional_head.absenteessection');


    Route::get('/manualAttendance', [AttendanceController::class, 'showManualEntry'])->name('clerk.manualAttendance');
    Route::post('/manualAttendance', [AttendanceController::class, 'store'])->name('attendance.store');
});

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


Route::middleware(['auth'])->group(function () {



    // Route::get('/schoolDashboard', fn() => view('school.schoolDashboard'));


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
Route::middleware(['auth'])->group(function () {

    // Route::get('/attendanceReport', action: [PrincipalController::class, "index"])->name(name: 'school.registerPrincipal');


    Route::get('/show', [ProfileController::class, 'show'])->name('profile.show');
    // Route::get('/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('password.change');
    // Route::post('/change-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('password.update');
    Route::get('/change-password', function () {
        return view('profile.change-password');
    })->name('password.change');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.password.update');


    // Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    // Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    // Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');




    // Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
    // Route::post('/leave/store', [LeaveApplicationController::class, 'store'])->name('leave.store');
    // Route::get('/leave/index', [LeaveApplicationController::class, 'index'])->name('leave.index');
});

Route::get('/leave/attachment/{id}/{index}', [LeaveApplicationController::class, 'serveAttachment'])
    ->name('leave.attachment')
    ->middleware('auth');


Route::middleware(['auth'])->group(function () {
    // Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
    // Route::post('/leave/store', [LeaveApplicationController::class, 'store'])->name('leave.store');

    // Principal routes
    // Route::patch('/leave/{id}/status', [PrincipalController::class, 'updateLeaveStatus'])->name('leave.updateStatus');

    // Other Principal routes



    Route::get('/teacher/leave-history', [LeaveApplicationController::class, 'history'])->name('leave.history');



    // Route::middleware(['auth'])->group(function () {
    //     Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
    //     Route::post('/leave', [LeaveApplicationController::class, 'store'])->name('leave.store');
    //     Route::get('/leave', [LeaveApplicationController::class, 'index'])->name('leave.index');
    //     Route::patch('/leave/{leaveId}/status', [LeaveApplicationController::class, 'updateStatus'])->name('leave.updateStatus');
    // });

    // Route::get('/leave/record', [LeaveApplicationController::class, 'schoolLeaveRecord'])->name('leave.record');


    // Route::get('/leave/history', [LeaveApplicationController::class, 'history'])->name('leave.history')->middleware('auth');


    // Route::get('/leave/record', [LeaveApplicationController::class, 'record'])->name('leave.record')->middleware('auth');
});
Route::get('/run-schedule', function () {
    Artisan::call('schedule:run');
    return 'Schedule executed';
});



//sec
// Leave-related routes
// Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
// Route::post('/leave', [LeaveApplicationController::class, 'store'])->name('leave.store');
// Route::get('/leave', [LeaveApplicationController::class, 'index'])->name('leave.index');
// Route::get('/leave/record', [LeaveApplicationController::class, 'record'])->name('leave.record');
// Route::get('/leave/history', [LeaveApplicationController::class, 'history'])->name('leave.history');
// Route::post('/leave/{leaveId}/status', [LeaveApplicationController::class, 'updateStatus'])->name('leave.updateStatus');




Route::middleware('auth')->group(function () {
    Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
    Route::post('/leave', [LeaveApplicationController::class, 'store'])->name('leave.store');
    Route::get('/leave', [LeaveApplicationController::class, 'index'])->name('leave.index');
    // Route::post('/leave/{leaveId}/status', [LeaveApplicationController::class, 'updateStatus'])->name('leave.updateStatus');
    Route::get('/leave/history', [LeaveApplicationController::class, 'history'])->name('leave.history');
    Route::get('/leave/record', [LeaveApplicationController::class, 'record'])->name('leave.record');
});


// Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
// Route::post('/leave/store', [LeaveApplicationController::class, 'store'])->name('leave.store');


//deks


Route::middleware(['auth'])->group(function () {
    // Sectional Head Routes
    Route::post('/sectional_head/leave/{id}/status', [SectionalController::class, 'updateLeaveStatus'])->name('sectional_head.update_leave_status');
    Route::get('/sectional_head/teachers/{leaveApplicationId}', [SectionalController::class, 'getTeachers'])->name('sectional_head.get_teachers');


    // Leave Application Routes
    Route::get('/leave/create', [LeaveApplicationController::class, 'create'])->name('leave.create');
    Route::post('/leave', [LeaveApplicationController::class, 'store'])->name('leave.store');
    Route::get('/leave/history', [LeaveApplicationController::class, 'history'])->name('leave.history');
});


Route::middleware(['auth'])->group(function () {




    Route::get('/assign-relief/{leaveApplicationId}', [SectionalController::class, 'assignReliefForm'])->name('sectional.assign_relief');
    Route::post('/sectional/relief/{leaveApplicationId}', [SectionalController::class, 'storeRelief'])->name('sectional.store_relief');






    Route::get('/teacher/notifications', [SectionalController::class, 'showNotifications'])->name('teacher.notifications');
});
Route::get('/password/reset', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
Route::post('/toggle-theme', function (\Illuminate\Http\Request $request) {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $theme = $request->input('theme');

    if ($user && in_array($theme, ['light', 'dark'])) {
        $user->theme = $theme;
        $user->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
})->middleware('auth');





Route::post('/toggle-theme', function (\Illuminate\Http\Request $request) {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $theme = $request->input('theme');

    if ($user && in_array($theme, ['light', 'dark'])) {
        $user->theme = $theme;
        $user->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
})->middleware('auth');



Route::middleware([PrincipalMiddleware::class])->group(function () {
    Route::get('/principalDashboard', [PrincipalController::class, 'dashboardview'])->name('principal.principalDashboard');
    Route::get('/liveAttendanceprin', [PrincipalController::class, 'liveAttendanceView'])->name('principal.liveAttendanceprin');
    Route::get('/absenteesprin', [PrincipalController::class, 'liveAbsentees'])->name('principal.absentee');
    // Route::get('/principalDashboard', fn() => view('principal.principalDashboard'));

    Route::get('/attendanceReport', function () {
        return view('principal.attendanceReport');
    });

    Route::get('/attendanceReport', action: [PrincipalController::class, "showAttendanceTable"])->name(name: 'attendance.Report');
    Route::patch('/leave/{leaveId}/status', [LeaveApplicationController::class, 'updateStatus'])->name('principal.leave.updateStatus');
    Route::get('/principal/dashboard', [PrincipalController::class, 'dashboard'])->name('principal.dashboard');

    Route::get('/principal/qrcode/{id}', [PrincipalController::class, 'showQRCode'])->name('principal.qrcode');
    Route::get('/principal/log-attendance/{id}', [PrincipalController::class, 'logAttendance'])->name('principal.logAttendance');
    Route::get('/principal/dashboardview', [PrincipalController::class, 'dashboardview'])->name('principal.dashboardview');
    Route::get('/principal/attendance-report', [PrincipalController::class, 'showAttendanceTable'])->name('principal.attendanceReport');
    Route::get('/principal/absentees', [PrincipalController::class, 'liveAbsentees'])->name('principal.absentees');
    Route::get('/principal/live-attendance', [PrincipalController::class, 'liveAttendanceView'])->name('principal.liveAttendance');
    Route::get('/attendanceReport/pdf', [PrincipalController::class, 'downloadPdf'])->name('attendanceReport.pdf');
    Route::get('/attendanceReport/pdf', [PrincipalController::class, 'downloadPdf'])->name('attendanceReport.pdf');
});

Route::middleware(['auth', 'role:PRINCIPAL'])->get('/test', function () {
    return 'You are a principal!';
});

Route::middleware([SectionMiddleware::class])->group(function () {
    Route::get('/sectionheadDashboard', fn() => view('sectional_head.sectionheadDashboard'));
    Route::get('/sectional/approved-leaves', [SectionalController::class, 'approvedLeaves'])->name('sectional.approved_leaves');
    Route::get('/sectional/approved-leaves', [SectionalController::class, 'approvedLeaves'])->name('sectional.approved_leaves');
    Route::get('/sectional/assign-relief/{leaveApplicationId}', [SectionalController::class, 'assignReliefForm'])->name('sectional.assign_relief');
    Route::post('/sectional/assign-relief/{leaveApplicationId}', [SectionalController::class, 'storeRelief'])->name('sectional.store_relief');
    Route::get('/sectional/absentees/export-pdf', [SectionalController::class, 'exportAbsenteesPdf'])->name('sectional.absentees.pdf');
    Route::get('/sectional_head/dashboard', [SectionalController::class, 'dashboard'])->name('sectional_head.dashboard');
    Route::get('/absenteessection', [SectionalController::class, 'liveAbsentees'])->name('sectional_head.absenteessection');
});

Route::middleware([ZonalMiddleware::class])->group(function () {
    Route::get('/zonalDashboard', function () {
        return view('zonal.zonalDashboard');
    });


    Route::get('/zonalDashboard', fn() => view('zonal.zonalDashboard'));
    Route::get('/registerschool', action: [SchoolController::class, "index"])->name(name: 'zonal.registerschool');

    Route::post('/registerschool', [SchoolController::class, "store"])->name('school.store');
});


Route::middleware([TeacherMiddleware::class])->group(function () {

    Route::get('/teacherDashboard', fn() => view('teacher.teacherDashboard'));
});

Route::middleware([SchoolMiddleware::class])->group(function () {

    Route::get('/registerPrincipal', action: [PrincipalController::class, "index"])->name(name: 'school.registerPrincipal');

    Route::post('/registerPrincipal', [PrincipalController::class, "store"])->name('principal.store');

    Route::get('/registerPrincipal', [PrincipalController::class, 'index'])->name('principal.register');
    Route::post('/registerPrincipal', [PrincipalController::class, 'store'])->name('principal.store');
    Route::get('/schoolDashboard', function () {
        if (!session('school_id')) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return view('school.schoolDashboard');
    });

    Route::get('/schoolDashboard', [SchoolController::class, 'schoolDashboard'])->name('school.dashboard');
    Route::get('/registerTeacher', action: [TeacherController::class, "index"])->name(name: 'school.registerTeacher');

    Route::post('/registerTeacher', [TeacherController::class, "store"])->name('teacher.store');

    Route::get('/registerSectionhead', action: [SectionalController::class, "index"])->name(name: 'school.registerSectionhead');

    Route::post('/registerSectionhead', [SectionalController::class, "store"])->name('sectionhead.store');



    Route::get('/registerClerk', action: [ClerkController::class, "index"])->name(name: 'school.registerClerk');

    Route::post('/registerClerk', [ClerkController::class, "store"])->name('clerk.store');
    Route::get('/school/manage-teachers', [SchoolController::class, 'manageTeachers'])->name('school.manageTeachers');

    Route::get('/manageUsers', [SchoolController::class, 'manageUsers'])->name('users.manage');
    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{id}/update', [TeacherController::class, 'update'])->name('teachers.update');
    Route::post('/teachers/{id}/status/{status}', [TeacherController::class, 'updateStatus'])->name('teachers.updateStatus');
    Route::put('/teachers/{id}/reactivate', [TeacherController::class, 'reactivate'])->name('teachers.reactivate');
    Route::get('/teacher_manage', [TeacherController::class, 'manage'])->name('teachers.manage');



    // Principal Management
    Route::get('/managePrincipals', [PrincipalController::class, 'managePrincipals'])->name('principals.manage');
    Route::get('/principals/{id}/edit', [PrincipalController::class, 'edit'])->name('principals.edit');
    Route::put('/principals/{id}/update', [PrincipalController::class, 'update'])->name('principals.update');
    Route::post('/principals/{id}/status/{status}', [PrincipalController::class, 'updateStatus'])->name('principals.updateStatus');
    Route::put('/principals/{id}/reactivate', [PrincipalController::class, 'reactivate'])->name('principals.reactivate');

    // Clerk Management Routes
    Route::get('/manageClerks', [ClerkController::class, 'manageClerks'])->name('clerks.manage');
    Route::get('/clerks/{id}/edit', [ClerkController::class, 'edit'])->name('clerks.edit');
    Route::put('/clerks/{id}/update', [ClerkController::class, 'update'])->name('clerks.update');
    Route::post('/clerks/{id}/status/{status}', [ClerkController::class, 'updateStatus'])->name('clerks.updateStatus');
    Route::put('/clerks/{id}/reactivate', [ClerkController::class, 'reactivate'])->name('clerks.reactivate');

    Route::get('/manageSectionals', [SectionalController::class, 'manageSectionals'])->name('sectionals.manage');
    Route::get('/sectionals/{id}/edit', [SectionalController::class, 'edit'])->name('sectionals.edit');
    Route::put('/sectionals/{id}/update', [SectionalController::class, 'update'])->name('sectionals.update');
    Route::post('/sectionals/{id}/status/{status}', [SectionalController::class, 'updateStatus'])->name('sectionals.updateStatus');
    Route::put('/sectionals/{id}/reactivate', [SectionalController::class, 'reactivate'])->name('sectionals.reactivate');

    Route::post('/check-transfer-nic', [TeacherController::class, 'checkTransferNIC'])->name('teachers.checkNIC');
    Route::post('/check-transfer-nic-principal', [PrincipalController::class, 'checkTransferNIC'])->name('principals.checkNIC');

    Route::post('/check-transfer-nic-clerk', [ClerkController::class, 'checkTransferNIC'])->name('clerks.checkNIC');
    Route::post('/sectionals/check-nic', [SectionalController::class, 'checkTransferNIC'])->name('sectionals.checkNIC');
});

Route::middleware([ClerkMiddleware::class])->group(function () {

    Route::get('/clerkDashbord', function () {
        return view('clerk.clerkDashboard');
    });
    Route::get('/absenteesclerk', [ClerkController::class, 'liveAbsentees'])->name('clerk.absenteesclerk');

    Route::get('/liveAttendanceclerk', [ClerkController::class, 'liveAttendanceView'])->name('clerk.liveAttendanceclerk');
    Route::get('/clerkDashboard', fn() => view('clerk.clerkDashboard'));

    Route::get('/clerk/leave/create', [LeaveApplicationController::class, 'clerkCreate'])->name('clerk.leave.create');
    Route::post('/clerk/leave/store', [LeaveApplicationController::class, 'clerkStore'])->name('clerk.leave.store');
    Route::get('/clerk/assign-duty-leave', [App\Http\Controllers\ClerkController::class, 'assignDutyLeave'])->name('clerk.assign.duty.leave');
});
