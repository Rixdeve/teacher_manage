<?php

use App\Http\Controllers\SchoolController;
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



// Route::get('/register-school', function () {
//     School::create([

//         'school_number' => request('school_number'),
//         'zonal_id' => '1',
//         'school_name' => request('school_name'),
//         'school_address_no' => request('school_address_no'),
//         'school_address_street' => request('school_address_street'),
//         'school_address_city' => request('school_address_city'),
//         'school_email' => request('school_email'),
//         'password' => 'School@123',
//         'school_phone' => request('school_phone'),
//         'status' => request('status')
//     ]);
//     return redirect('/zonalDashboard');
// });