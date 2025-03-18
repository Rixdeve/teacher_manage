<?php

use App\Models\School;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/registerschool', function () {
    return view('registerschool');
});

// Route::get('/register', function () {
//     dd('post request here');
// });

Route::get('/zonalDashboard', function () {
    return view('zonalDashboard');
});

Route::get('/registerschool', function () {
    School::create([

        'school_number' => request('school_number'),
        'zonal_id' => '1',
        'school_name' => request('school_name'),
        'school_address_no' => request('school_address_no'),
        'school_address_street' => request('school_address_street'),
        'school_address_city' => request('school_address_city'),
        'school_email' => request('school_email'),
        'password' => 'School@123',
        'school_phone' => request('school_phone'),
        'status' => request('status')
    ]);
    return redirect('/zonalDashboard');
});
