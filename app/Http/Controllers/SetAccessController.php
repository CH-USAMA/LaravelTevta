<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StrengthSession;
use App\Models\SessionHistory;
use Illuminate\Support\Facades\Schema;
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
        $request->to_date = Carbon\Carbon::parse($request->to_date)->format('y-m-d');
        $request->from_date = Carbon\Carbon::parse($request->from_date)->format('y-m-d');
        if($request->has('to_session'))
        {
            $session = $request->to_session;
            $name = 'ses'.$session;
          if (!Schema::hasTable($name)) {
                
              return redirect()->back()->with('error','Invalid Session Name');
          }
        }
        // dd($request->all());

        $request->validate( [
            'from_date' =>  ['required', 'date_format:Y-m-d', 'before_or_equal:to_date','after_or_equal:' . date('Y-m-d')],
            'to_date'  => ['required', 'date_format:Y-m-d','after_or_equal:from_date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->id],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
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
            $request->status = isset($request->status) ? 'active' : 'inactive';

            User::where('id',$request->id)->update(
                [
                    'role' => $request->role,
                    'firstname' => $request->first_name,
                    'lastname' => $request->last_name,
                    'email' => $request->email,
                    'phonenumber' => $request->phone,
                    'status' => $request->status,
                    'session' => $request->to_session,

                ]
            );
            // dd($user->getAllPermissions());
        }

        return redirect()->route('InstitueLevelAccess')->with('message','Settings Updated Successfully!');
       
    }
    public function setsessionlist()
    {
        $sessions = SessionHistory::all();
        return view('setaccess_module.setSessionList',compact('sessions'))->with('no', 1);
    }
    

    public function setattendance()
    {
        return view('setaccess_module.setAutoAttendance');

    }
    
    
    
    public function strengthSessionWise()
    {
        return view('setaccess_module.strengthSessionWise');
    }

    public function strengthSessionWiseUpdate(Request $request)
    {
        if($request->has('session'))
        {
            $session = $request->session;
            $name = 'ses'.$session;
          if (!Schema::hasTable($name)) {
                
              return redirect()->back()->with('error','Invalid Session Name');
          }
        }else{
            return redirect()->back()->with('error','Invalid Session Name');
        }
        
        $strengthSession = StrengthSession::where('session_name', $request->session)->first();
        // dd($strengthSession->id);
        if(!empty($strengthSession->id))
        {

            StrengthSession::where('id',$strengthSession->id)->update(
                [
                    'strength' => empty($request->session_strength) ? 0 : $request->session_strength
                ]
            );
            return redirect()->route('strengthSessionWise')->with('message','Strength Updated Successfully!');

        }else{


            StrengthSession::create(
                [
                    'session_name' => $request->session,
                    'strength' => empty($request->session_strength) ? 0 : $request->session_strength
                ]
            );
            return redirect()->route('strengthSessionWise')->with('message','Strength Added Successfully!');

        }

       
    }
    
}
