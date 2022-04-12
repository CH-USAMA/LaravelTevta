<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Check_Date
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) { 
       
        if(Auth::user()->role == 'Institute')
        {
            // dd(Auth::user()->role); 
            $to_date = Auth::user()->to_date;
            $from_date = Auth::user()->from_date;
            if(($to_date != "") && ($from_date != ""))
            {
                $currentDate = date('Y-m-d');
                // $currentDate = '2022-04-28';

                $currentDate = date('Y-m-d', strtotime($currentDate)); 
                $to_date = date('Y-m-d', strtotime($to_date));
                $from_date = date('Y-m-d', strtotime($from_date));  
                // dd($currentDate,$to_date,$from_date); 
                if (($currentDate >= $from_date) && ($currentDate <= $to_date)){   
                    // dd('write');
                    return $next($request);
                }else{    
                    $permissions = array('Data Module');
                    Auth::user()->syncPermissions($permissions);
                    return redirect()->route('homepage');
                    return $next($request);
                }
            }else{

                $permissions = array('Data Module');
                Auth::user()->syncPermissions($permissions);
                return redirect()->route('homepage');
            }
           
            // dd('compare date');
           
        }
    }
        return $next($request);
        
       
    }
}
