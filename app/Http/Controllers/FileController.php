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
use App\Models\AgeLimit;

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

    //  agelimit
    public function setagelimit()
    {
        $agelimit = AgeLimit::first();
        // dd($agelimit->agelimit);
        return view('File_module.setagelimit',compact('agelimit'));
    }

    public function saveagelimit(Request $request)
    {
        
        $request->validate( [
            'agelimit' => ['required','numeric'],
          ]);
          $userid = Auth::user()->username;
          AgeLimit::where('id',$request->id)->update([
            'agelimit'  => $request->agelimit,
            'UserID'      => $userid,
        ]);

        return redirect()->route('setagelimit')->with('message','Age Limit Updated');
    }


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
        $request->validate( [
           'session_code' => ['required'],
           'start_date' =>  ['required', 'date_format:Y-m-d', 'before_or_equal:end_date','after_or_equal:' . date('Y-m-d')],
           'end_date'  => ['required', 'date_format:Y-m-d','after_or_equal:start_date']
         ]);

        $request->to_date = Carbon\Carbon::parse($request->start_date)->format('y-m-d');
        $request->from_date = Carbon\Carbon::parse($request->end_date)->format('y-m-d');

        
        $mon = $request->session_code;
        $name = 'ses'.$mon;
        if (Schema::hasTable($name)) {
            return redirect()->route('newSession')->with('error','Session Already Exist');
        }

        // dd($request->all());
        DB::statement("CREATE TABLE ses".$mon." (
            id INT(4) NOT NULL AUTO_INCREMENT,
            ses_name VARCHAR(50) DEFAULT NULL,
            ses_serial_no VARCHAR(40) DEFAULT NULL,
            ses_cnic_no VARCHAR(150) DEFAULT NULL,
            ses_roll_no VARCHAR(150) DEFAULT NULL,
            ses_dur VARCHAR(2) DEFAULT NULL,
            ses_reg_no VARCHAR(180) DEFAULT NULL,
            ses_sex VARCHAR(10) DEFAULT NULL,
            ses_group VARCHAR(10) DEFAULT NULL,
            ses_st_name VARCHAR(195) DEFAULT NULL,
            ses_f_name VARCHAR(195) DEFAULT NULL,
            ses_pic_name VARCHAR(180)DEFAULT NULL,
            ses_pic LONGBLOB DEFAULT NULL,
            ses_cnt_code VARCHAR(40) DEFAULT NULL,
            ses_trade_code VARCHAR(30) DEFAULT NULL,
            ses_trade_name VARCHAR(150) DEFAULT NULL,
            ses_qual_code VARCHAR(20) DEFAULT NULL,
            ses_st_doa DATE DEFAULT NULL,
            ses_st_dob DATE DEFAULT NULL,
            ses_alow_reg VARCHAR(10) DEFAULT NULL,
            ses_att_per int(3) DEFAULT NULL,
            ses_att_th VARCHAR(100) DEFAULT NULL,
            ses_att_pr VARCHAR(100) DEFAULT NULL,
            ses_mks_th INT(30) DEFAULT NULL,
            ses_mks_pr INT(30) DEFAULT NULL,
            ses_th_pass INT(30) DEFAULT NULL,
            ses_pr_pass INT(30) DEFAULT NULL,
            ses_th_obt INT(30) DEFAULT NULL,
            ses_pr_obt INT(30) DEFAULT NULL,
            ses_mks_agr INT(30) DEFAULT NULL,
            ses_result VARCHAR(120) DEFAULT NULL,
            ses_remarks VARCHAR(120) DEFAULT NULL,
            ses_chance INT(1) DEFAULT NULL,
            ses_anl_sup VARCHAR(100) DEFAULT NULL,
            ses_status VARCHAR(100) DEFAULT NULL,
            userID VARCHAR(50) DEFAULT NULL,
            ses_examTitle VARCHAR(90) DEFAULT NULL,
            ses_submit INT(10) DEFAULT NULL,
            ses_etid CHAR(1) DEFAULT NULL,
            PRIMARY KEY (`id`,`ses_reg_no`)
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");


            $userid = Auth::user()->username;
            // $startdate = $request->from_date;
            // $enddate = $request->to_date;

           
            DB::statement("INSERT INTO seshis (s_name,s_start_date,s_end_date,s_status,userID) VALUES('$mon','$startdate','$enddate','1','$userid')");
            return redirect()->route('sessionlist')->with('message','Session is created');

            
            


       
        return view('File_module.sessions.newSession');
    }


    public function editSession($id)
    {
        $id_org = \Crypt::decrypt($id); 
        $session = SessionHistory::find($id_org);
    //    dd($session);

        return view('File_module.sessions.newSession',compact('session'));
    }

    public function updatesession(Request $request)
    {
        $startdate = $request->start_date;
        $enddate = $request->end_date;

        $request->validate( [
           'start_date' =>  ['required', 'date_format:Y-m-d', 'before_or_equal:end_date','after_or_equal:' . date('Y-m-d')],
           'end_date'  => ['required', 'date_format:Y-m-d','after_or_equal:start_date']
         ]);

        $request->to_date = Carbon\Carbon::parse($request->start_date)->format('y-m-d');
        $request->from_date = Carbon\Carbon::parse($request->end_date)->format('y-m-d');
         $userid = Auth::user()->username;
        //  dd($request);

        SessionHistory::where('id',$request->id)->update([
            's_start_date'  => $request->start_date,
            's_end_date'  => $request->end_date,
            'UserID'      => $userid,
        ]);
       

        return redirect()->route('sessionlist')->with('message','Session is Updated Successfully');

        
   }


    public function closeSession()
    {
        return view('File_module.sessions.closeSession');
    }

    public function closingsession(Request $request)
    {
        // dd($request->all());
        $request->validate( [
            'close_Session' => ['required']
          ]);
          $session = $request->close_Session;
          $name = 'ses'.$session;
        if (Schema::hasTable($name)) {
                $getSession = SessionHistory::select('id','s_close_date')->where('s_name',$session)->first();
                // dd($getSession->s_close_date);
                if($getSession->s_close_date == null)
                {
                    // $getSession->s_close_date = date('Y-m-d');
                    // $getSession->save();

                    $yr = SUBSTR($session,2,2);
                    $this->getStudentCl($session, $yr);

                    return redirect()->route('closeSession')->with('message','Session is Closed');

                }else{
                    return redirect()->route('closeSession')->with('error','Session is Already Closed');
                }
        }else{
            return redirect()->route('closeSession')->with('error','invalid Session Name');
        }

    }

    
    public function masterfile()
    {
        return view('File_module.masterfile.CreateMasterFile');
    } 
    public function addMasterFile(Request $request)
    {
        $this->validate($request, [
            'masterfile' => ['required','numeric'],
        ]);

        $month = $request->masterfile;
       
        $name = 'mas'.$month;
        if (Schema::hasTable($name)) {
            return redirect()->route('masterfile')->with('error','Master File Already Exist');
        }
        // dd('Herwe');
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

        DB::statement("CREATE TABLE mas".$month." (
            id INT(6) NOT NULL AUTO_INCREMENT,
            mas_serial_no VARCHAR(4) DEFAULT NULL,
            mas_cnic_no VARCHAR(15) DEFAULT NULL,
            mas_roll_no VARCHAR(15) DEFAULT NULL,
            mas_dur VARCHAR(2) DEFAULT NULL,
            mas_reg_no VARCHAR(18) DEFAULT NULL,
            mas_session1 VARCHAR(5) DEFAULT NULL,
            mas_session2 VARCHAR(5) DEFAULT NULL,
            mas_session3 VARCHAR(5) DEFAULT NULL,
            mas_sex VARCHAR(1) DEFAULT NULL,
            mas_group VARCHAR(1) DEFAULT NULL,
            mas_st_name VARCHAR(35) DEFAULT NULL,
            mas_f_name VARCHAR(35) DEFAULT NULL,
            mas_pic_name VARCHAR(18)DEFAULT NULL,
            mas_pic LONGBLOB DEFAULT NULL,
            mas_cnt_code VARCHAR(4) DEFAULT NULL,
            mas_trade_code VARCHAR(3) DEFAULT NULL,
            mas_trade_name VARCHAR(50) DEFAULT NULL,
            mas_qual_code VARCHAR(2) DEFAULT NULL,
            mas_st_doa DATE DEFAULT NULL,
            mas_st_dob DATE DEFAULT NULL,
            mas_alow_reg VARCHAR(1) DEFAULT NULL,
            mas_att_per int(3) DEFAULT (80),
            mas_att_th1 VARCHAR(1) DEFAULT NULL,
            mas_att_pr1 VARCHAR(1) DEFAULT NULL,
            mas_mks_th INT(3) DEFAULT NULL,
            mas_mks_pr INT(3) DEFAULT NULL,
            mas_th_pass INT(3) DEFAULT NULL,
            mas_pr_pass INT(3) DEFAULT NULL,
            mas_th_obt1 INT(3) DEFAULT NULL,
            mas_pr_obt1 INT(3) DEFAULT NULL,
            mas_mks_agr1 INT(3) DEFAULT NULL,
            mas_result1 VARCHAR(20) DEFAULT NULL,
            mas_remarks1 VARCHAR(20) DEFAULT NULL,
            mas_att_th2 VARCHAR(1) DEFAULT NULL,
            mas_att_pr2 VARCHAR(1) DEFAULT NULL,
            mas_th_obt2 INT(3) DEFAULT NULL,
            mas_pr_obt2 INT(3) DEFAULT NULL,
            mas_mks_agr2 INT(3) DEFAULT NULL,
            mas_result2 VARCHAR(20) DEFAULT NULL,
            mas_remarks2 VARCHAR(20) DEFAULT NULL,
            mas_att_th3 VARCHAR(1) DEFAULT NULL,
            mas_att_pr3 VARCHAR(1) DEFAULT NULL,
            mas_anl_sup VARCHAR(50) DEFAULT NULL,
            mas_examTitle VARCHAR(50) DEFAULT NULL,
            mas_th_obt3 INT(3) DEFAULT NULL,
            mas_pr_obt3 INT(3) DEFAULT NULL,
            mas_mks_agr3 INT(3) DEFAULT NULL,
            mas_result3 VARCHAR(20) DEFAULT NULL,
            mas_remarks3 VARCHAR(20) DEFAULT NULL,
            mas_fin_result VARCHAR(20) DEFAULT NULL,
            mas_chance INT(1) DEFAULT NULL,
            mas_cer1_no VARCHAR(6) DEFAULT NULL,
            mas_cer1_date DATE DEFAULT NULL,
            mas_cer2_no VARCHAR(6) DEFAULT NULL,
            mas_cer2_date DATE DEFAULT NULL,
            userID VARCHAR(50) DEFAULT NULL,
            mas_etid CHAR(1) DEFAULT NULL,
             PRIMARY KEY (`id`,`mas_reg_no`)
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");

            DB::statement("CREATE TABLE serialNo".$month." (
                `id` int(1) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `sNo` int(6) DEFAULT NULL,
                `year` varchar(2) DEFAULT NULL
              )");


              DB::statement("INSERT INTO serialNo".$month." (sNo, `year`) VALUES(0, $month)");
              return redirect()->route('masterfile')->with('message','Master File has been created');

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
    public function saveexamtitle(Request $request)
     {
        //  dd($request->all());
         $request->validate( [
            'titleName'   =>  ['required','unique:examtitle'],
            'exThMks'     =>  ['required','numeric'],
            'exPrMks'     =>  ['required','numeric'],
            'exThPass'    =>  ['required','numeric'],
            'exPrPass'    =>  ['required','numeric'],
            'exDur'       =>  ['required','numeric'],
          ]);
          $userid = Auth::user()->username;
        //   dd([
        //     'qualCode'   => $request->qualCode,
        //     'qualName'   => $request->qualName,
        //     'qualStatus' => $status,
        //     'UserID'       => $userid,
        // ]);
        //  dd($request->all());

        ExamTitle::create([
            'titleName'   => $request->titleName,
            'exThMks'  => $request->exThMks,
            'exPrMks'  => $request->exPrMks,
            'exThPass' => $request->exThPass,
            'exPrPass' => $request->exPrPass,
            'exDur'    => $request->exDur,
            'UserID'      => $userid,
        ]);
        

        return redirect()->route('examtitlelist')->with('message','Exam Title has been added');

         
    }
    public function editexamtitle($id)
    {
        $id_org = \Crypt::decrypt($id); 
        $examtitle = ExamTitle::find($id_org);
       // dd($user);

        return view('File_module.Examtitle.addexamtitle',compact('examtitle'));
    }
    public function updateexamtitle(Request $request)
    {
        // dd($request->all(),Auth::user()->username);
        $request->validate( [
            'exThMks'     =>  ['required','numeric'],
            'exPrMks'     =>  ['required','numeric'],
            'exThPass'    =>  ['required','numeric'],
            'exPrPass'    =>  ['required','numeric'],
            'exDur'       =>  ['required','numeric'],
          ]);


         $userid = Auth::user()->username;
        //  dd($request);

        ExamTitle::where('id',$request->id)->update([
            'exThMks'  => $request->exThMks,
            'exPrMks'  => $request->exPrMks,
            'exThPass' => $request->exThPass,
            'exPrPass' => $request->exPrPass,
            'exDur'    => $request->exDur,
            'UserID'      => $userid,
        ]);
       

       return redirect()->route('examtitlelist')->with('message','Exam Title has been Updated');

        
   }


    // Trade List


    public function tradelist()
    {
        $trades = Trades::all();
        return view('File_module.Trades.tradelist',compact('trades'))->with('no', 1);
    }
    public function addtrade()
     {
         return view('File_module.Trades.addtrade');
     }
     public function savetrade(Request $request)
     {
        //  dd($request->all());
         $request->validate( [
            'tradeCode'      =>  ['required','unique:trades'],
            'tradeName'      =>  ['required'],
            'tradeThMks'     =>  ['required','numeric'],
            'tradePrMks'     =>  ['required','numeric'],
            'tradeThPass'    =>  ['required','numeric'],
            'tradePrPass'    =>  ['required','numeric'],
            'tradeDur'       =>  ['required','numeric'],
          ]);
          $status = isset($request->status) ? 'A' : 'D';
          $userid = Auth::user()->username;
        //   dd([
        //     'qualCode'   => $request->qualCode,
        //     'qualName'   => $request->qualName,
        //     'qualStatus' => $status,
        //     'UserID'       => $userid,
        // ]);
        //  dd($request->all());

        Trades::create([
            'tradeCode'   => $request->tradeCode,
            'tradeName'   => $request->tradeName,
            'tradeThMks'  => $request->tradeThMks,
            'tradePrMks'  => $request->tradePrMks,
            'tradeThPass' => $request->tradeThPass,
            'tradePrPass' => $request->tradePrPass,
            'tradeDur'    => $request->tradeDur,
            'UserID'      => $userid,
        ]);
        

        return redirect()->route('tradelist')->with('message','Trade has been added');

         
    }

    public function edittrade($id)
    {
        $id_org = \Crypt::decrypt($id); 
        $trade = Trades::find($id_org);
       // dd($user);

        return view('File_module.Trades.addtrade',compact('trade'));
    }
    public function updatetrade(Request $request)
    {
        // dd($request->all(),Auth::user()->username);
        $request->validate( [
           
            'tradeName'      =>  ['required'],
            'tradeThMks'     =>  ['required','numeric'],
            'tradePrMks'     =>  ['required','numeric'],
            'tradeThPass'    =>  ['required','numeric'],
            'tradePrPass'    =>  ['required','numeric'],
            'tradeDur'       =>  ['required','numeric'],
          ]);


         $status = isset($request->status) ? 'A' : 'D';
         $userid = Auth::user()->username;
        //  dd($request);

        Trades::where('id',$request->id)->update([

            'tradeName'   => $request->tradeName,
            'tradeThMks'  => $request->tradeThMks,
            'tradePrMks'  => $request->tradePrMks,
            'tradeThPass' => $request->tradeThPass,
            'tradePrPass' => $request->tradePrPass,
            'tradeDur'    => $request->tradeDur,
            'UserID'      => $userid,
        ]);
       

       return redirect()->route('tradelist')->with('message','Trade has been Updated');

        
   }
    // Qualification Codes
    public function qualcodelist()
    {
        $qualcodes = QualCodes::all()->sortBy("qualCode");;
        return view('File_module.QualCode.qualcodelist',compact('qualcodes'))->with('no', 1);

    }
    public function addqualcode()
     {
         return view('File_module.QualCode.addqualcode');
     }
     public function savequalcode(Request $request)
     {
        //  dd($request->all());
         $request->validate( [
            'qualCode' =>  ['required','unique:qual'],
            'qualName' =>  ['required','unique:qual'],
            
          ]);
          $status = isset($request->status) ? 'A' : 'D';
          $userid = Auth::user()->username;
        //   dd([
        //     'qualCode'   => $request->qualCode,
        //     'qualName'   => $request->qualName,
        //     'qualStatus' => $status,
        //     'UserID'       => $userid,
        // ]);

        QualCodes::create([
            'qualCode'   => $request->qualCode,
            'qualName'   => $request->qualName,
            'qualStatus' => $status,
            'UserID'       => $userid,
        ]);
        

        return redirect()->route('qualcodelist')->with('message','Qualification Code has been added');

         
    }
    public function editqualcode($id)
    {
        $id_org = \Crypt::decrypt($id); 
        $qual = QualCodes::find($id_org);
       // dd($user);

        return view('File_module.QualCode.addqualcode',compact('qual'));
    }
    public function updatequalcode(Request $request)
    {
        // dd($request->all(),Auth::user()->username);
        $request->validate( [
           'qualCode' =>  ['required'],
           'qualName' =>  ['required'],
           
         ]);
         $status = isset($request->status) ? 'A' : 'D';
         $userid = Auth::user()->username;
        //  dd($request);

       QualCodes::where('id',$request->id)->update([
           'qualCode'   => $request->qualCode,
           'qualName'   => $request->qualName,
           'qualStatus' => $status,
           'UserID'       => $userid,
       ]);
       

       return redirect()->route('qualcodelist')->with('message','Qualification Code has been Updated');

        
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
          
        $centres = Centres::find($request->id);
        // dd($centres);
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
        
        return redirect()->route('centrecodelist')->with('message','CentreCode has been Updated Successfully');
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


    function getStudentCl($mon, $yr){
        ini_set('mysql.connect_timeout',300);
        ini_set('default_socket_timeout',300);
        
        $x = 0;
        $gettype = array();
        $query = "SELECT * FROM ses".$mon;
        $result =  DB::select($query);
        // dd($result);
        //echo $query; die();
        $array = json_decode(json_encode($result), true);
        // dd($array);
         foreach($array as $row)
         {
            // dd($row);
             $x++;
             $gettype[$x]['id'] = $row['id'];
             $gettype[$x]['serialno'] = $row['ses_serial_no'];
             $gettype[$x]['cnicno'] = $row['ses_cnic_no'];
             $gettype[$x]['rollno'] = $row['ses_roll_no'];
             $gettype[$x]['regno'] = $row['ses_reg_no'];
             $gettype[$x]['sex'] = $row['ses_sex'];
             $gettype[$x]['group'] = $row['ses_group'];
             $gettype[$x]['stname'] = $row['ses_st_name'];
             $gettype[$x]['stfname'] = $row['ses_f_name'];
             $gettype[$x]['picname'] = $row['ses_pic_name'];
             $gettype[$x]['pic'] = $row['ses_pic'];
             $gettype[$x]['cntcode'] = $row['ses_cnt_code'];
             $gettype[$x]['tradecode'] = $row['ses_trade_code'];
             $gettype[$x]['tradename'] = $row['ses_trade_name'];
             $gettype[$x]['qualcode'] = $row['ses_qual_code'];
             $gettype[$x]['stdoa'] = $row['ses_st_doa'];
             $gettype[$x]['stdob'] = $row['ses_st_dob'];
             $gettype[$x]['alowreg'] = $row['ses_alow_reg'];
             $gettype[$x]['attper'] = $row['ses_att_per'];
             $gettype[$x]['attth'] = $row['ses_att_th'];
             $gettype[$x]['attpr'] = $row['ses_att_pr'];
             $gettype[$x]['mksth'] = $row['ses_mks_th'];
             $gettype[$x]['mkspr'] = $row['ses_mks_pr'];
             $gettype[$x]['thpass'] = $row['ses_th_pass'];
             $gettype[$x]['prpass'] = $row['ses_pr_pass'];
             $gettype[$x]['thobt'] = $row['ses_th_obt'];
             $gettype[$x]['probt'] = $row['ses_pr_obt'];
             $gettype[$x]['mksagr'] = $row['ses_mks_agr'];
             $gettype[$x]['result'] = $row['ses_result'];
             $gettype[$x]['remarks'] = $row['ses_remarks'];
             $gettype[$x]['chance'] = $row['ses_chance'];
             $gettype[$x]['status'] = $row['ses_status'];
             $gettype[$x]['userid'] = $row['userID'];
             $gettype[$x]['exid'] = $row['ses_etid'];
         }
 
          $getres = $gettype;
        //   dd($getres);
          $i = 1;
          foreach($getres as $row){
            //echo $row['cnicno']."<br>";
                // dd($row);
             $serialno = $row['serialno'];
             $cnicno = $row['cnicno'];
             $rollno = $row['rollno'];
             $regno = $row['regno'];
             $sex = $row['sex'];
             $group = $row['group'];
             $stname = $row['stname'];
             $stfname = $row['stfname'];
             $picname = $row['picname'];
             $pic = $row['pic'];
             $cntcode = $row['cntcode'];
             $tradecode = $row['tradecode'];
             $tradename = $row['tradename'];
             $qualcode = $row['qualcode'];
             $stdoa = $row['stdoa'];
             $stdob = $row['stdob'];
             $alowreg = $row['alowreg'];
             $attper = $row['attper'];
             $attth = $row['attth'];
             $attpr = $row['attpr'];
             $mksth = $row['mksth'];
             $mkspr = $row['mkspr'];
             $thpass = $row['thpass'];
             $prpass = $row['prpass'];
             $thobt = $row['thobt'];
             $probt = $row['probt'];
             $mksagr = $row['mksagr'];
             $result = $row['result'];
             $remarks = $row['remarks'];
             $chance = $row['chance'];
             $status = $row['status'];
             $userid = $row['userid'];
             $session = $mon;
             $finalresult ='';

            $sqlstr = "INSERT INTO mas".$yr." (id,mas_serial_no,mas_cnic_no,mas_roll_no,mas_reg_no,mas_sex,mas_group,mas_st_name,mas_f_name,mas_cnt_code,mas_trade_code,mas_trade_name,mas_qual_code,mas_st_doa,mas_st_dob,mas_alow_reg,mas_session.$chance,mas_att_per,mas_att_th.$chance,mas_att_pr.$chance,mas_mks_th,mas_mks_pr,mas_th_obt.$chance,mas_pr_obt.$chance,mas_mks_agr.$chance,mas_result.$chance,mas_remarks.$chance,mas_fin_result,$chance,'$userid') VALUES ('','$serialno','$cnicno','$rollno','$regno','$mon','$sex','$group','$stname','$stfname','$cntcode','$tradecode','$tradename','qualcode','$stdoa','$stdob','$alowreg','$session'.$chance,attper,'$attth'.$chance,'$attpr'.$chance,$mksth,$mkspr,$thobt.$chance,$probt.$chance,$mksagr.$chance,$result.$chance,'$remarks'.$chance,$finalresult,$chance,'$userid')";
            //echo '<br>'.$sqlstr; die();
            // dd($sqlstr);
            $rec = DB::statement($sqlstr);

            $i++;
          }
          $userid = Auth::user()->username;
          $dte = date('Y-m-d');
          $hisup = "UPDATE seshis SET s_status = '0', s_close_date = '$dte', userID = '$userid' WHERE s_name = '$mon'";
          $rec = DB::statement($hisup);

          return $hisup;
            /* echo $cnicno.'<br>';
            echo $regno.'<br>';
            echo $mon.'<br>';
            echo $stname.'<br>';
            echo $stfname.'<br>';
            echo $cntcode.'<br>';
            echo $tradecode.'<br>';
            echo $tradename.'<br>';
            echo $stdob.'<br>';
            echo $alowreg.'<br>';
            echo $marks.'<br>';
            echo $result.'<br>';
            echo $remarks.'<br>';
            echo $group.'<br>';
            echo $status.'<br>';
            echo $userid;
            die(); */
 
     }
}
