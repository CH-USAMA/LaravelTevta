<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SessionHistory;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon;

class SetAccessController extends Controller
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
    public function index()
    {
        return view('setaccess_module.setPunjabLevelAccess');
    }

    public function allpunjabAccesssave(Request $request)
    {
        $request->to_date = Carbon\Carbon::parse($request->to_date)->format('y-m-d');
        $request->from_date = Carbon\Carbon::parse($request->from_date)->format('y-m-d');
        // dd($request->all());

        $request->validate( [
            'from_date' =>  ['required', 'date_format:Y-m-d', 'before_or_equal:to_date','after_or_equal:' . date('Y-m-d')],
            'to_date'  => ['required', 'date_format:Y-m-d','after_or_equal:from_date']
          ]);
        //   dd($request->all());
       
        
        // Total Access
        // if($request->has('total_access'))
        // {
        //     User::where('role','Institute')->update(
        //         [
        //             'status' => 'inactive'
        //         ]
        //     );
        // }else{
        //     User::where('role','Institute')->update(
        //         [
        //             'status' => 'active'
        //         ]
        //     );
        // }
            $permissions = array('Data Module');
            !empty($request->data_access) ? array_push($permissions,'Enter Data') : '';
            !empty($request->edit_list_access) ? array_push($permissions,'Edit List') : '';
            !empty($request->admit_access) ? array_push($permissions,'Admittance Slip') : '';
            !empty($request->attendance_access) ? array_push($permissions,'Enter Attendance') : '';

        // Data Access

            $all_users = User::where('role','Institute')->get();
            foreach($all_users as $user)
            {
                $user->syncPermissions($permissions);
                $user->from_date = $request->from_date;
                $user->to_date = $request->to_date;
                $user->save();

            }
            // ->syncPermissions($permissions);
            Session::flash('message','Punjab Level Access Settings Updated Successfully!'); 
            Session::flash('alert-class', 'alert-success'); 
            return redirect()->back();
            dd('here');

       
    }

    public function InstitueLevelAccess()
    {
        $user = User::where('role','Institute')->get();
      
        return view('setaccess_module.setInstituteLevelAccess',compact('user'))->with('no', 1);

    }

    public function InstitueLevelAccessEdit($userid)
    {
        $userid_org = \Crypt::decrypt($userid); 
        $user = User::find($userid_org);
        return view('setaccess_module.editInstituteLevelAccess',compact('user'));

    }
    public function InstitueLevelAccessUpdate(Request $request)
    {
        // dd($request->all());
        $request->to_date = Carbon\Carbon::parse($request->to_date)->format('y-m-d');
        $request->from_date = Carbon\Carbon::parse($request->from_date)->format('y-m-d');
        // dd($request->all());

        $request->validate( [
            'from_date' =>  ['required', 'date_format:Y-m-d', 'before_or_equal:to_date','after_or_equal:' . date('Y-m-d')],
            'to_date'  => ['required', 'date_format:Y-m-d','after_or_equal:from_date']
          ]);
        $user = User::find($request->id);
        // dd($user);   
        if($user->role == 'Institute')
        {
            $permissions = array('Data Module');
            !empty($request->data_access) ? array_push($permissions,'Enter Data') : '';
            !empty($request->edit_list_access) ? array_push($permissions,'Edit List') : '';
            !empty($request->admit_access) ? array_push($permissions,'Admittance Slip') : '';
            !empty($request->attendance_access) ? array_push($permissions,'Enter Attendance') : '';
            // dd($permissions);
            // dd($user->getAllPermissions());
            // $user->revokePermissions($permissions);

            $user->syncPermissions($permissions);
            $user->from_date = $request->from_date;
            $user->to_date = $request->to_date;
            $user->save();
            // dd($user->getAllPermissions());
        }

        Session::flash('message','Settings Updated Successfully!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->back();
       
    }
    public function setsessionlist()
    {
        $sessions = SessionHistory::all();
        return view('setaccess_module.setSessionList',compact('sessions'))->with('no', 1);
    }
    
}
