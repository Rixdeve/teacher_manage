<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Database\QueryException;
use App\Models\User;
use Exception;
// use function Laravel\Prompts\alert;

class SchoolController extends Controller
{
    public function schoolDashboard()
    {
        // Get the current school ID from session
        $schoolId = session('school_id');

        // Count users with the same school_id
        $userCount = User::where('school_id', $schoolId)->count();

        return view('school.schoolDashboard', compact('userCount'));
    }

    public function index()
    {
        return view('zonal.registerschool');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $zonalId = session('zone_office_id');

        $request->validate([
            'school_number' => 'required|unique:schools,school_number',
            'school_name' => 'required',
            'school_address_no' => 'required',
            'school_address_street' => 'required',
            'school_address_city' => 'required',
            'school_email' => 'required|email|unique:schools,school_email',
            'school_phone' => 'required|unique:schools,school_phone',
            'status' => 'required',
        ]);
        try {
            School::create([
                'school_number' => $request->school_number,
                'zonal_id' => $zonalId,
                'school_name' => $request->school_name,
                'school_address_no' => $request->school_address_no,
                'school_address_street' => $request->school_address_street,
                'school_address_city' => $request->school_address_city,
                'school_email' => $request->school_email,
                'password' => bcrypt('School@123'), // Secure password hashing
                'school_phone' => $request->school_phone,
                'status' => $request->status
            ]);

            return redirect('/zonalDashboard')->with('success', 'School registered successfully!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect('/registerschool')->with('error', 'School already exists!');
            }
        } catch (Exception $e) {
            return redirect('/registerschool')->with('error', 'An error occurred!');
        }
    }

    public function manageUsers()
    {
        $schoolId = session('school_id');

        $users = User::where('school_id', $schoolId)
                    ->whereIn('role', ['TEACHER', 'CLERK', 'PRINCIPAL'])
                    ->get();

        return view('school.manageUsers', compact('users'));
    }

    public function managePrincipals()
    {
        $schoolId = session('school_id');

        $principals = User::where('role', 'PRINCIPAL')
                        ->where('school_id', $schoolId)
                        ->get();

        return view('school.managePrincipals', compact('principals'));
    }

    public function manageSectionals()
    {
        $schoolId = session('school_id');
        $sectionals = User::where('role', 'SECTIONAL_HEAD')
                          ->where('school_id', $schoolId)
                          ->get();

        return view('school.manageSectionals', compact('sectionals'));
    }

    public function manageTeachers()
    {
        // Fetch the currently logged-in school's ID from session
        $schoolId = session('school_id');

        // Get all teachers belonging to the current school
        $teachers = User::where('role', 'TEACHER')
                        ->where('school_id', $schoolId)
                        ->get();

        return view('school.manageTeachers', compact('teachers'));
    }

    public function manageClerks()
    {
        $schoolId = session('school_id');

        $clerks = User::where('role', 'CLERK')
                    ->where('school_id', $schoolId)
                    ->get();

        return view('school.manageClerks', compact('clerks'));
    }
}
