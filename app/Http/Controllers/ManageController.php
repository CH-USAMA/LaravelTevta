<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\SessionHistory;
use App\Models\Centres;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class ManageController extends Controller
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
        return view('home');
    }

    public function deleteSelected(Request $request)
    {
        // return redirect()->back()->with('error','Deleted Successfully');
       if($request->has('delete'))
       {
           $delete = $request->delete;
           $ids = implode(",", $delete);
           $table = $request->table;
        //    DB::enableQueryLog();
           DB::table($table)->whereIn('id', $delete)->delete(); 
           return redirect()->back()->with('message','Deleted Successfully');
        //    dd(DB::getQueryLog());
        /*
        return redirect()->route('your route name')->with('message','Data added Successfully');

return redirect()->route('your route name')->with('error','Data Deleted');

return redirect()->route('your route name')->with('Warning','Are you sure you want to delete? ');

return redirect()->route('your route name')->with('info','This is xyz information');
        
        
        */
           



       }
    }

    public function changeStatus(Request $request)
    {
        dd($request);
    }

    public function changeStatusUser(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json(['success'=>'Status changed successfully.']);
    }

    public function changeStatusSession(Request $request)
    {
        // dd($request);
        $session = SessionHistory::find($request->session_id);
        $session->s_status = $request->status;
        $session->save();
  
        return response()->json(['success'=>'Status changed successfully.']);
    }

    public function changeStatusCentre(Request $request)
    {
        $Centre = Centres::find($request->centre_id);
        $Centre->centreStatus = $request->status;
        $Centre->save();
  
        return response()->json(['success'=>'Status changed successfully.']);
    }
    
    public function changeStatusRole(Request $request)
    {
        $user = Role::find($request->role_id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json(['success'=>'Status changed successfully.']);
    }
}
