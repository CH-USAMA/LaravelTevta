<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function enterYear()
    {
        return view('Data_module.enterYear');
    }

    public function enterStudentDetails()
    {
        return view('Data_module.enterStudentDetail');

    }

    // public function studentinformation()
    // {
    //     return view('Data_module.studentsInformation');

    // }

    // public function sessionStudentList(Request $request)
    // {
    //     $session = $request->session;
    //     $query = "Select * from ses".$session;
    //     $students = DB::select($query);
    //     // dd($result);


    //     return view('Data_module.sessionStudentList',compact('students'))->with('no', 1);

    // }
    
    public function homepage()
    {
        return view('Dashboard');
    }
}
