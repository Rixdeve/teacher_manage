<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Attendance;
use App\Models\ZoneOffice;


// use function Laravel\Prompts\alert;

class ZonalController extends Controller
{
    public function dashboard()
    {
        $zoneOffice = \App\Models\ZoneOffice::find(session('zone_office_id'));

        return view('zonal.zonalDashboard', compact('zoneOffice'));
    }

    public function index()
    {
        return view('registerZonal');
    }

    public function store(Request $request)
    {


        $request->validate([
            'zonal_name' => 'required|string|max:255',
            'zone_address_no' => 'required|string',
            'zone_address_street' => 'required|string',
            'zone_address_city' => 'required|string',
            'zone_email' => 'required|email|unique:zone_offices,zone_email',
        ]);

        ZoneOffice::create([
            'zone_name' => $request->zonal_name,
            'zone_address_no' => $request->zone_address_no,
            'zone_address_street' => $request->zone_address_street,
            'zone_address_city' => $request->zone_address_city,
            'zone_email' => $request->zone_email,
            'password' => Hash::make('Zonal@123'),
        ]);

        return redirect()->back()->with('success', 'Zonal office registered successfully!');
    }
}



//     public function store(Request $request)
//     {
//         // dd($request->all());
//         // $schoolId = Auth::user()->school_id;

//         $request->validate([
//             'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'school_index' => 'required|numeric',
//             'user_address_no' => 'required|string',
//             'user_address_street' => 'required|string',
//             'user_address_city' => 'required|string',
//             'user_nic' => 'required|string|unique:users,user_nic',
//             'user_dob' => 'required|date',
//             'user_email' => 'required|email|unique:users,user_email',
//             'user_phone' => 'required|numeric|digits:10|unique:users,user_phone',
//             'profile_picture' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Only images, max size 2MB
//             'status' => 'required',
//         ]);
//         if ($request->hasFile('profile_picture')) {
//             $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
//         } else {
//             $imagePath = null; // Default if no image is uploaded
//         }
//         try {
//             User::create([
//                 'school_id' => 109,
//                 'role' => 'CLERK',
//                 'user_password' => Hash::make('Clerk@123'),
//                 'first_name' => $request->first_name,
//                 'last_name' => $request->last_name,
//                 'school_index' => $request->school_index,
//                 'user_address_no' => $request->user_address_no,
//                 'user_address_street' => $request->user_address_street,
//                 'user_address_city' => $request->user_address_city,
//                 'user_nic' => $request->user_nic,
//                 'user_dob' => $request->user_dob,
//                 'user_email' => $request->user_email,
//                 'user_phone' => $request->user_phone,
//                 'profile_picture' => $imagePath,
//                 'status' => $request->status,
//                 'registered_date' => now(),

//             ]);
//             return redirect('/schoolDashboard')->with('success', 'Clerk registered successfully!');
//         } catch (QueryException $e) {
//             if ($e->errorInfo[1] == 1062) {
//                 return redirect('/registerClerk')->with('error', 'Clerk already exists!');
//             }
//         } catch (\Exception $e) {
//             return redirect('/registerClerk')->with('error', 'An error occurred!');
//         }
//     }
// }