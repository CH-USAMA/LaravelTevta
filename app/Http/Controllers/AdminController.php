<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use Session;


class AdminController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::all();
        return view('admin.userslist',compact('user'))->with('no', 1);
    }

    public function userslistboard()
    {
        $user = User::where('role','Board')->get();
      
        return view('admin.userlistboard',compact('user'))->with('no', 1);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editUser($userid)
    {
        $userid_org = \Crypt::decrypt($userid); 
        $user = User::find($userid_org);
        // dd($user);

        return view('admin.editUser',compact('user'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {
        //
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$request->id],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
        ]);
        $user = User::find($request->id);
        if($request->role != 'Institute')
        {
            $permissions = array('Enter Data','Edit List','Admittance Slip','Enter Attendance');
            !empty($request->file_module) ? array_push($permissions,'File Module') : '';
            !empty($request->data_module) ? array_push($permissions,'Data Module') : '';
            !empty($request->report_module) ? array_push($permissions,'Reports Module') : '';
            !empty($request->backup_module) ? array_push($permissions,'Backup Module') : '';
            $user->syncRoles($request->role);
            $user->syncPermissions($permissions);
        }
       
        // dd($permissions);
        // if($request->has('file_module'))
        // {
        //     if($user->hasPermissionTo('File Module'))
        //     {
        //         $a = 1;
        //     }else{
        //         $user->givePermissionTo('File Module');
        //     }
        // }else{
        //     $user->revokePermissionTo('File Module');
        // }

        // if($request->has('data_module'))
        // {
        //     if($user->hasPermissionTo('Data Module'))
        //     {
        //         $a = 1;
        //     }else{
        //         $user->givePermissionTo('Data Module');
        //     }
        // }else{
        //     $user->revokePermissionTo('Data Module');

        // }
        // if($request->has('report_module'))
        // {
        //     if($user->hasPermissionTo('Reports Module'))
        //     {
        //         $a = 1;
        //     }else{
        //         $user->givePermissionTo('Reports Module');
        //     }
        // }else{
        //     $user->revokePermissionTo('Reports Module');

        // }
        // if($request->has('backup_module'))
        // {
        //     if($user->hasPermissionTo('Backup Module'))
        //     {
        //         $a = 1;
        //     }else{
        //         $user->givePermissionTo('Backup Module');
        //     }
        // }else{
        //     $user->revokePermissionTo('Backup Module');

        // }
        $request->status = isset($request->status) ? 'active' : 'inactive';

        User::where('id',$request->id)->update(
            [
                'role' => $request->role,
                'firstname' => $request->first_name,
                'lastname' => $request->last_name,
                'email' => $request->email,
                'phonenumber' => $request->phone,
                'status' => $request->status,
            ]
        );
        Session::flash('message','Settings Updated Successfully!'); 
        Session::flash('alert-class', 'alert-success'); 
        if($request->role == 'Board')
        {
            return redirect()->route('userslistboard');
        }
        return redirect()->route('userslist');
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function controlpanel()
    {
        return view('admin.controlpanel');
    }
    public function changePassword()
    {
        return view('admin.changePassword');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function initializePassword()
    {
        return view('admin.initializePassword');
    }
    

    public function initializePasswordSave(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255','confirmed'],
        ]);
        
        // dd($request->all());
        $user = User::where('username',$request->username)->get();
        // dd(sizeof($user));
        if(sizeof($user) == 0){
            $msg = "Invalid Username.";
            Session::flash('invalidUsername', $msg);
            // Session::flash('message', ''.$request->username.' Password Changed!'); 
            Session::flash('alert-class', 'alert-danger'); 
            return back();
        }else{
            // dd('here');
            User::where('username',$request->username)->update(
                [
                    'password' => Hash::make($request->password)
                ]
            );
        }
        Session::flash('message', ''.$request->username.' Password Changed!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->back()->with('message','Password Changed Successfully');
    }
}
