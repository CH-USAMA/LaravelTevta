<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB;
use App\Models\ExamTitle;
use App\Models\Trades;
use App\Models\QualCodes;
use App\Models\Centres;
use App\Models\Group;
use App\Models\SessionHistory;
use Illuminate\Validation\Validator; 

use Session;
use Carbon;
use Auth;



class FileController extends Controller
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
    // Session
    public function sessionlist()
    {
        $sessions = SessionHistory::all();
        return view('File_module.sessions.sessionlist',compact('sessions'))->with('no', 1);
    }
    public function newSession()
    {
        return view('File_module.sessions.newSession');
    }
    public function addSession(Request $request)
    {
        $startdate = $request->start_date;
        $enddate = $request->end_date;

        $request->to_date = Carbon\Carbon::parse($request->start_date)->format('y-m-d');
        $request->from_date = Carbon\Carbon::parse($request->end_date)->format('y-m-d');
        $mon = $request->session_code;


        // dd($request->all());
        // DB::statement("CREATE TABLE ses".$mon." (
        //     id INT(4) NOT NULL AUTO_INCREMENT,
        //     ses_name VARCHAR(5) DEFAULT NULL,
        //     ses_serial_no VARCHAR(4) DEFAULT NULL,
        //     ses_cnic_no VARCHAR(15) DEFAULT NULL,
        //     ses_roll_no VARCHAR(15) DEFAULT NULL,
        //     ses_dur VARCHAR(2) DEFAULT NULL,
        //     ses_reg_no VARCHAR(18) DEFAULT NULL,
        //     ses_sex VARCHAR(1) DEFAULT NULL,
        //     ses_group VARCHAR(1) DEFAULT NULL,
        //     ses_st_name VARCHAR(35) DEFAULT NULL,
        //     ses_f_name VARCHAR(35) DEFAULT NULL,
        //     ses_pic_name VARCHAR(18)DEFAULT NULL,
        //     ses_pic LONGBLOB DEFAULT NULL,
        //     ses_cnt_code VARCHAR(4) DEFAULT NULL,
        //     ses_trade_code VARCHAR(3) DEFAULT NULL,
        //     ses_trade_name VARCHAR(50) DEFAULT NULL,
        //     ses_qual_code VARCHAR(2) DEFAULT NULL,
        //     ses_st_doa DATE DEFAULT NULL,
        //     ses_st_dob DATE DEFAULT NULL,
        //     ses_alow_reg VARCHAR(1) DEFAULT NULL,
        //     ses_att_per int(3) DEFAULT NULL,
        //     ses_att_th VARCHAR(1) DEFAULT NULL,
        //     ses_att_pr VARCHAR(1) DEFAULT NULL,
        //     ses_mks_th INT(3) DEFAULT NULL,
        //     ses_mks_pr INT(3) DEFAULT NULL,
        //     ses_th_pass INT(3) DEFAULT NULL,
        //     ses_pr_pass INT(3) DEFAULT NULL,
        //     ses_th_obt INT(3) DEFAULT NULL,
        //     ses_pr_obt INT(3) DEFAULT NULL,
        //     ses_mks_agr INT(3) DEFAULT NULL,
        //     ses_result VARCHAR(20) DEFAULT NULL,
        //     ses_remarks VARCHAR(20) DEFAULT NULL,
        //     ses_chance INT(1) DEFAULT NULL,
        //     ses_anl_sup VARCHAR(1) DEFAULT NULL,
        //     ses_status VARCHAR(1) DEFAULT NULL,
        //     userID VARCHAR(50) DEFAULT NULL,
        //     ses_etid CHAR(1) DEFAULT NULL,
        //     PRIMARY KEY (`id`,`ses_reg_no`)
        //     ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");


            $userid = Auth::user()->username;
            // $startdate = $request->from_date;
            // $enddate = $request->to_date;

           
            DB::statement("INSERT INTO seshis (s_name,s_start_date,s_end_date,s_status,userID) VALUES('$mon','$startdate','$enddate','1','$userid')");
            dd($request->all());
            


        // $request->validate( [
        //     'from_date' =>  ['required', 'date_format:Y-m-d', 'before_or_equal:to_date','after_or_equal:' . date('Y-m-d')],
        //     'to_date'  => ['required', 'date_format:Y-m-d','after_or_equal:from_date']
        //   ]);
        return view('File_module.sessions.newSession');
    }

    public function closeSession()
    {
        return view('File_module.sessions.closeSession');
    }
    public function masterfile()
    {
        return view('File_module.masterfile.CreateMasterFile');
    } 
    public function addMasterFile(Request $request)
    {
        $this->validate($request, [
            'masterfile' => ['required'],
        ]);

        $month = $request->masterfile;
        $name = 'masterfile'.$month;

        // Schema::create($name, function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->string('mas_serial_no')->nullable();
        //         $table->string('mas_cnic_no')->nullable();
        //         $table->string('mas_roll_no')->nullable();
        //         $table->string('mas_dur')->nullable();
        //         $table->string('mas_reg_no8')->nullable();
        //         $table->string('mas_session1')->nullable();
        //         $table->string('mas_session2')->nullable();
        //         $table->string('mas_session3')->nullable();
        //         $table->string('mas_sex')->nullable();
        //         $table->string('mas_group')->nullable();
        //         $table->string('mas_st_name')->nullable();
        //         $table->string('mas_f_name')->nullable();
        //         $table->string('mas_pic_name')->nullable();
        //         $table->string('mas_pic')->nullable();
        //         $table->string('mas_cnt_code')->nullable();
        //         $table->string('mas_trade_code')->nullable();
        //         $table->string('mas_trade_name')->nullable();
        //         $table->string('mas_qual_code')->nullable();
        //         $table->string('mas_st_doa')->nullable();
        //         $table->string('mas_st_dob')->nullable();
        //         $table->string('mas_alow_reg')->nullable();
        //         $table->string('mas_att_per')->nullable();
        //         $table->string('mas_att_th1')->nullable();
        //         $table->string('mas_att_pr1')->nullable();
        //         $table->string('mas_mks_th')->nullable();
        //         $table->string('mas_mks_pr')->nullable();
        //         $table->string('mas_th_pass')->nullable();
        //         $table->string('mas_pr_pass')->nullable();
        //         $table->string('mas_th_obt1')->nullable();
        //         $table->string('mas_pr_obt1')->nullable();
        //         $table->string('mas_mks_agr1')->nullable();
        //         $table->string('mas_result1')->nullable();
        //         $table->string('mas_remarks1')->nullable();
        //         $table->string('mas_att_th2')->nullable();
        //         $table->string('mas_att_pr2')->nullable();
        //         $table->string('mas_th_obt2')->nullable();
        //         $table->string('mas_pr_obt2')->nullable();
        //         $table->string('mas_mks_agr2')->nullable();
        //         $table->string('mas_result2')->nullable();
        //         $table->string('mas_remarks2')->nullable();
        //         $table->string('mas_att_th3')->nullable();
        //         $table->string('mas_att_pr3')->nullable();
        //         $table->string('mas_th_obt3')->nullable();
        //         $table->string('mas_pr_obt3')->nullable();
        //         $table->string('mas_mks_agr3')->nullable();
        //         $table->string('mas_result3')->nullable();
        //         $table->string('mas_remarks3')->nullable();
        //         $table->string('mas_fin_result')->nullable();
        //         $table->string('mas_chance')->nullable();
        //         $table->string('mas_cer1_no')->nullable();
        //         $table->string('mas_cer1_date')->nullable();
        //         $table->string('mas_cer2_no')->nullable();
        //         $table->string('mas_cer2_date')->nullable();
        //         $table->string('userID')->nullable();
        //         $table->string('mas_etid')->nullable();
        //         $table->timestamps();
        //     });

            // DB::statement("CREATE TABLE serialNo".$month." (
            //     `id` int(1) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            //     `sNo` int(6) DEFAULT NULL,
            //     `year` varchar(2) DEFAULT NULL
            //   )");


              DB::statement("INSERT INTO serialNo".$month." (sNo, `year`) VALUES(0, $month)");
        dd($request);
        
        return view('File_module.masterfile.CreateMasterFile');
    }
    // Exam Titles
    public function examtitlelist()
    {
        $examtitles = ExamTitle::all();
        return view('File_module.Examtitle.examtitlelist',compact('examtitles'))->with('no', 1);
    }

    public function addexamtitle()
    {
        return view('File_module.Examtitle.addexamtitle');
    }
    // Trade List


    public function tradelist()
    {
        $trades = Trades::all();
        return view('File_module.Trades.tradelist',compact('trades'))->with('no', 1);
    }

    // Qualification Codes
    public function qualcodelist()
    {
        $qualcodes = QualCodes::all();
        return view('File_module.QualCode.qualcodelist',compact('qualcodes'))->with('no', 1);

    }

     // Centre Codes
     public function centrecodelist()
     {
         $centrecodes = Centres::all();
         return view('File_module.CentreCode.centrecodelist',compact('centrecodes'))->with('no', 1);
 
     }
     public function addcentrecode()
     {
         return view('File_module.CentreCode.addcentre');
     }
     public function savecentrecode(Request $request)
     {
         $request->validate( [
            'centrecode' =>  ['required','unique:centres'],
            'centreName' =>  ['required'],
            'disttName' =>  ['required'],
            'centreAddress' =>  ['required'],
            'centreZone' =>  ['required'],
            'centrePrincipal' =>  ['required'],
            'centreContactNo' =>  ['required'],
            'CentreEmail' =>  ['required'],
            
          ]);
          $status = isset($request->status) ? 'A' : 'D';
          $userid = Auth::user()->username;
        //   dd($request);

        Centres::create([
            'centrecode' =>  $request->centrecode,
            'centreName' => $request->centreName,
            'centreDisttName' => $request->disttName,
            'centreAddress' => $request->centreAddress,
            'centreZone' => $request->centreZone,
            'centrePrincipal' => $request->centrePrincipal,
            'centreContactNo' => $request->centreContactNo,
            'CentreEmail' => $request->CentreEmail,
            'CentreStatus' => $status,
            'CentreOC' => 'O',
            'UserID' => $userid,
            'serialNo' => 0,

        ]);
        

        return redirect()->route('centrecodelist')->with('message','CentreCode has been added');

         return view('File_module.CentreCode.addcentre');
     }
     public function editcentrecode($id)
     {
        //  dd('here');
         $id_org = \Crypt::decrypt($id); 
         $centrecode = Centres::find($id_org);
        // dd($centrecode);

         return view('File_module.CentreCode.addcentre',compact('centrecode'));
     }

     public function updatecentrecode(Request $request)
     {
        //  dd('here');
        $request->validate( [
            'centreName' =>  ['required'],
            'disttName' =>  ['required'],
            'centreAddress' =>  ['required'],
            'centreZone' =>  ['required'],
            'centrePrincipal' =>  ['required'],
            'centreContactNo' =>  ['required'],
            'CentreEmail' =>  ['required'],
            
          ]);
          $status = isset($request->status) ? 'A' : 'D';
          $userid = Auth::user()->username;
          dd($request);
        $centres = Centres::find($request->id);
        $centres->centreName = $request->centreName;
        $centres->centreDisttName = $request->disttName;
        $centres->centreAddress = $request->centreAddress;
        $centres->centreZone = $request->centreZone;
        $centres->centrePrincipal = $request->centrePrincipal;
        $centres->centreContactNo = $request->centreContactNo;
        $centres->CentreEmail = $request->CentreEmail;
        $centres->CentreStatus = $status;
        $centres->UserID = $userid;
        $centres->save();
         $id_org = \Crypt::decrypt($id); 
         $centrecode = Centres::find($id_org);
        // dd($centrecode);

         return view('File_module.CentreCode.addcentre',compact('centrecode'));
     }
     // Group
     public function groupshiftlist()
     {
         $groupshifts = Group::all();
         return view('File_module.GroupShift.groupshiftlist',compact('groupshifts'))->with('no', 1);
     }
     public function editgroupshift($id)
     {
         $id_org = \Crypt::decrypt($id); 
         $group = Group::find($id_org);
        // dd($user);

         return view('File_module.GroupShift.addgroupshift',compact('group'));
     }
     public function addgroupshift()
     {
         return view('File_module.GroupShift.addgroupshift');
     }
     public function updategroupshift(Request $request)
     {
        
        $request->validate( [
            'groupName' =>  ['required'],
          ]);
        $group = Group::find($request->id);
        $group->groupName = $request->groupName;
        $group->save();
        
       
        return redirect()->route('groupshiftlist')->with('message','Group Shift has been Updated');
     }
     public function savegroupshift(Request $request)
     {
        
        $request->validate( [
            'groupName' =>  ['required','unique:groupp'],
          ]);
        Group::create([
            'groupName' => $request->groupName,
        ]);
        
        $msg = "Froup Shift has been added.";
        Session::flash('message', $msg);
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->route('groupshiftlist')->with('message','Group Shift has been added');
         return view('File_module.GroupShift.addgroupshift');
     }

    public function homepage()
    {
        return view('Dashboard');
    }
}
