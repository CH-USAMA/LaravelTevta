<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Trades;
use App\Models\Centres;
use App\Models\Group;
use App\Models\ExamTitle;
use App\Models\QualCodes;
use Carbon;
use Session;
use Auth;


class StudentController extends Controller
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
      public function enterStudentDetails()
    {
        return view('Data_module.enterStudentDetail');

    }

    public function studentinformation()
    {
        return view('Data_module.studentsInformation');

    }


   

    public function sessionStudentList(Request $request)
    {

      $query = '';
      $session = $request->session;
      session(['session' => $session]);
      if ($request->session()->has('session')) {
        $session =  session('session');
    } 
    if($request->has('SelectCentre'))
    {
        $centreCode = $request->SelectCentre; 
        $query .= " and ses_cnt_code = '$centreCode'";
    }
     if($request->has('SelectGroup'))
    {
        $group =$request->SelectGroup;

        $query .= " and ses_group = '$group'"; 
      
    }
     if($request->has('SelectTrade'))
    {
       $trade =$request->SelectTrade; 
       $query .= " and ses_trade_name = '$trade'";
    }
      $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);

        if($checkTable == false){
           return  "'failure', 'Session not exist'"; 
       }
  
    
    $querymain = "Select * from ses".$session;

    $students = DB::select($querymain.' where 1=1 '.$query);
    return view('Data_module.sessionStudentList',compact('students','session'));

    }

     public function sessionStudentListget(Request $request)
    {
        // dd($request->all()); 
          
        $session = $request->session;
        if($request->has('session'))
        {
            session(['session' => $session]);
        }
        if ($request->session()->has('session')) {
            $session =  session('session');
        } 
        $query = "Select * from ses".$session;
        $students = DB::select($query);
        return view('Data_module.sessionStudentList',compact('students','session'));

    }
    
  
    
        public function addStudent()
    {
        $data['trades']    = Trades::all();
        $data['Group']     = Group::all();
        $data['Centres']   = Centres::all();
        $data['ExamTitle'] = ExamTitle::all();
        $data['QualCode'] = QualCodes::all();
        return view('Data_module.addStudent',compact($data));
    }

    protected function createStudent(Request $request)
    {
        // dd($request->all());

        $request->validate([
            // 'email' => ['required',  'unique:users,email,'.$request->id],
            'Session' => ['required', 'string', 'max:255'],
            'AnualSuply' => ['required', 'string', 'max:255'],
            'Centre' => ['required', 'string', 'max:255'],
            'GroupShift' => ['required', 'string', 'max:255'],
            'CourseDuration' => ['required', 'string', 'max:255'],
            'ExamTitle' => ['required', 'string', 'max:255'],
            'EnterTradeCode' => ['required', 'string', 'max:255'],
            'SelectTrade' => ['required', 'string', 'max:255'],
            'SerialNo' => ['required', 'string', 'max:255'],
            'CollegeRollNo' => ['required', 'string', 'max:255'],
            'SelectGender' => ['required', 'string', 'max:255'],
            'StudentCNICNo' => ['required', 'string', 'max:255'],
            'StudentName' => ['required', 'string', 'max:255'],
            'FatherName' => ['required', 'string', 'max:255'],
            'DateofAdmission' => ['required', 'string', 'max:255'],
            'DateofBirth' => ['required', 'string', 'max:255'],
            'SelectQualification' => ['required', 'string', 'max:255'],

        ]);
        $qualification = '';
        $userId = Auth::user()->id;
        $request->DateofAdmission = Carbon\Carbon::parse($request->DateofAdmission)->format('y-m-d');
        $request->DateofBirth = Carbon\Carbon::parse($request->DateofBirth)->format('y-m-d');
        $now = Carbon\Carbon::now();

          $query = "SELECT * FROM agelimit";
          $agelimit = DB::select($query);
          $student_agelimit = $agelimit[0]->agelimit;
          $dateless = strtotime($now.'-'.$student_agelimit.'year');
          $datelessthan18 = $dateless;

          $dob = strtotime($request->DateofBirth);
          if($dob>= $datelessthan18){
            return  "'failure', 'Student Age is less then $student_agelimit years!'"; 

          }else{

         } 
         $codeTrade =  $request->EnterTradeCode;
         $nameTrade = $request->SelectTrade;
         if($codeTrade || $nameTrade){
         $query = "SELECT * FROM trades WHERE tradeCode ='$codeTrade' OR tradeName = '$nameTrade'";  


         $query_result[0] = DB::select($query);
         
         $tradeTheoryMarks    =$query_result[0][0]->tradeThMks;
         $tradePracticalMarks =$query_result[0][0]->tradePrMks; 
         $tradeTheoryPass     =$query_result[0][0]->tradeThPass; 
         $tradePracticalPass  =$query_result[0][0]->tradePrPass;

        }

         
        $data['userId']              = $userId;  
        $data['Session']             = $request->Session;
        $data['AnualSuply']          = $request->AnualSuply;
        $data['Centre']              = $request->Centre;
        $data['GroupShift']          = $request->GroupShift;
        $data['CourseDuration']      = $request->CourseDuration;
        $data['ExamTitle']           = $request->ExamTitle;
        $data['SerialNo']            = $request->SerialNo;
        $data['SelectGender']        = $request->SelectGender;
        $data['StudentCNICNo']       = $request->StudentCNICNo;
        $data['StudentName']         = $request->StudentName;
        $data['FatherName']          = $request->FatherName;
        $data['DateofAdmission']     = $request->DateofAdmission;
        $data['DateofBirth']         = $request->DateofBirth;
        $data['SelectTrade']         = $request->SelectTrade;
        $data['EnterTradeCode']      = $request->EnterTradeCode;
        $data['SelectQualification'] = $request->SelectQualification;
        $data['CollegeRollNo']       = $request->CollegeRollNo;
        $data['DateofAdmission']     = $request->DateofAdmission;
        $data['DateofBirth']         = $request->DateofBirth;
        $data['SelectQualification'] = $request->SelectQualification;
        $data['status']              = isset($request->status) ? 'active' : 'inactive';
        $qual_name                   = $data['SelectQualification'];
        $qualification               = QualCodes::where(['qualName' => $qual_name])->first();
        $qualCode                    = $qualification['qualCode'];
        $data['qualCode']            = $qualCode;
        $data['alowreg']             = 1;
        $data['chance']              = 1;
        $data['ses_mks_th']          = $tradeTheoryMarks;  
        $data['ses_mks_pr']          = $tradePracticalMarks;  
        $data['ses_th_pass']         = $tradeTheoryPass;  
        $data['ses_pr_pass']         = $tradePracticalPass; 
        if($request->image)
        {

            $file = $request->image;
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $image_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->image->move(public_path('avatars'), $image_name);

        }

        $data['image']             = $image_name;
        Session::put('student_data', $data);
        $student_data= Session::get('student_data');

        // Centre code 
        $centre_code = substr($request->Centre, 0, 4);
       
        // CNIC Validation 
        $cnicno = $data['StudentCNICNo'];
        $ll=strlen($cnicno);
        $dd1=substr($cnicno,-2,1);
        $dd2=substr($cnicno,-10,1);
        if($ll != 15){ 
            dd("Invalid CNIC length....Please enter another CNIC No");
        } elseif($dd1 != "-" OR $dd2 != "-"){
            dd("Illegel CNIC formate....Please enter another CNIC No.");

        } 


        // for registration number 
        $ses = $data['Session'];
        $yr = SUBSTR($ses,2,2);
        $query = "SELECT * FROM serialno".$yr." WHERE id=1";
        $query_result[0] = DB::select($query);
        $no= $query_result[0][0]->sNo;
        $no = $no + 1;
        $stno = "".$no;

        if(strlen($stno) == 1){
           $serno = "00000".$stno;
       } else if(strlen($stno) == 2){
           $serno = "0000".$stno;
       } else if(strlen($stno) == 3){
           $serno = "000".$stno;
       } else if(strlen($stno) == 4){
           $serno = "00".$stno;
       } else if(strlen($stno) == 5){
           $serno = "0".$stno;
       }

        $registration_no = $centre_code.'-'.'S'.$ses.'-'.$serno;

        // for registration number 
        
       $data=array(
        "ses_name"=>$student_data['Session'],
        "ses_anl_sup"=>$student_data['AnualSuply'],
        "ses_cnt_code"=>$centre_code,
        "ses_group"=>$student_data['GroupShift'],
        "ses_dur"=>$student_data['CourseDuration'],
        "ses_serial_no"=>$student_data['SerialNo'],
        "ses_cnic_no"=>$student_data['StudentCNICNo'],
        "ses_sex"=>$student_data['SelectGender'],
        "ses_st_name"=>$student_data['StudentName'],
        "ses_f_name"=>$student_data['FatherName'],
        "ses_st_doa"=>$student_data['DateofAdmission'],
        "ses_st_dob"=>$student_data['DateofBirth'],
        "ses_trade_name"=>$student_data['SelectTrade'],
        "ses_trade_code"=>$student_data['EnterTradeCode'],
        "ses_roll_no"=>$student_data['CollegeRollNo'],
        "ses_status"=>$student_data['status'],
        "ses_qual_code"=>$student_data['qualCode'],
        "ses_reg_no"=>$registration_no,
        "userId"=>$student_data['userId'],
        "ses_chance"=>$student_data['alowreg'],
        "ses_alow_reg"=>$student_data['chance'],
        "ses_examTitle"=>$student_data['ExamTitle'],
        "ses_mks_th"=>$student_data['ses_mks_th'],
        "ses_mks_pr"=>$student_data['ses_mks_pr'],
        "ses_th_pass"=>$student_data['ses_th_pass'],
        "ses_pr_pass"=>$student_data['ses_pr_pass'],
        "ses_pic_name"=>$image_name,
    );

       $session_table = 'ses'.$student_data['Session'];
       $checkinsert=DB::table($session_table)->insert($data);
       DB::statement("UPDATE serialno".$yr." SET sNo=".$no ); 
       return  "'success', 'Student has been  Registered Sucessfully!'"; 
   }


       protected function updateStudent(Request $request)
    {
        $request->validate([
            // 'email' => ['required',  'unique:users,email,'.$request->id],
            'Session' => ['required', 'string', 'max:255'],
            'AnualSuply' => ['required', 'string', 'max:255'],
            'Centre' => ['required', 'string', 'max:255'],
            'GroupShift' => ['required', 'string', 'max:255'],
            'CourseDuration' => ['required', 'string', 'max:255'],
            'ExamTitle' => ['required', 'string', 'max:255'],
            'EnterTradeCode' => ['required', 'string', 'max:255'],
            'SelectTrade' => ['required', 'string', 'max:255'],
            'SerialNo' => ['required', 'string', 'max:255'],
            'CollegeRollNo' => ['required', 'string', 'max:255'],
            'SelectGender' => ['required', 'string', 'max:255'],
            'StudentCNICNo' => ['required', 'string', 'max:255'],
            'StudentName' => ['required', 'string', 'max:255'],
            'FatherName' => ['required', 'string', 'max:255'],
            'DateofAdmission' => ['required', 'string', 'max:255'],
            'DateofBirth' => ['required', 'string', 'max:255'],
            'SelectQualification' => ['required', 'string', 'max:255'],

        ]);;
        // dd($request->all());
        
        $userId = Auth::user()->id;
        $request->DateofAdmission = Carbon\Carbon::parse($request->DateofAdmission)->format('y-m-d');
        $request->DateofBirth = Carbon\Carbon::parse($request->DateofBirth)->format('y-m-d');
        $now = Carbon\Carbon::now();
        $datelessthan18 = strtotime($now.'-18 year');
        $dob = strtotime($request->DateofBirth);
        if($dob>= $datelessthan18){
            return  "'failure', 'Student Age is less then 18 years!'"; 

        }else{

        } 
        $data['userId']              = $userId;  
        $data['Session']             = $request->Session;
        $data['AnualSuply']          = $request->AnualSuply;
        $data['Centre']              = $request->Centre;
        $data['GroupShift']          = $request->GroupShift;
        $data['CourseDuration']      = $request->CourseDuration;
        $data['ExamTitle']           = $request->ExamTitle;
        $data['SerialNo']            = $request->SerialNo;
        $data['SelectGender']        = $request->SelectGender;
        $data['StudentCNICNo']       = $request->StudentCNICNo;
        $data['StudentName']         = $request->StudentName;
        $data['FatherName']          = $request->FatherName;
        $data['DateofAdmission']     = $request->DateofAdmission;
        $data['DateofBirth']         = $request->DateofBirth;
        $data['SelectTrade']         = $request->SelectTrade;
        $data['EnterTradeCode']      = $request->EnterTradeCode;
        $data['SelectQualification'] = $request->SelectQualification;
        $data['CollegeRollNo']       = $request->CollegeRollNo;
        $data['DateofAdmission']     = $request->DateofAdmission;
        $data['DateofBirth']         = $request->DateofBirth;
        $data['SelectQualification'] = $request->SelectQualification;
        $data['status']              = isset($request->status) ? 'active' : 'inactive';
        $qual_name                   = $data['SelectQualification'];
        $query                       = QualCodes::where(['qualName' => $qual_name])->first();
        $qualCode                    = $query['qualCode'];
        $data['qualCode']            = $qualCode;
        $data['alowreg']             = 1;
        $data['chance']              = 1;

        
        if($request->image)
        {
            $get_old_pic = DB::table('ses'.$data['Session'])->where('ses_cnic_no',$data['StudentCNICNo'] )->first();
            
            $get_old_pic_name = $get_old_pic->ses_pic_name;
            $path = public_path().'/avatars/'.$get_old_pic_name;
            unlink($path);

            $file = $request->image;

            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $firstextension = $file->getClientOriginalExtension();
            $image_name = $filename.'_'.time().rand(1,100).'.'.$firstextension;
            $request->image->move(public_path('avatars'), $image_name);

        }


        Session::put('student_data', $data);
        $student_data= Session::get('student_data');

        // Centre code 
        $centre_code = substr($request->Centre, 0, 4);
       
        // CNIC Validation 
        $cnicno = $data['StudentCNICNo'];
        $ll=strlen($cnicno);
        $dd1=substr($cnicno,-2,1);
        $dd2=substr($cnicno,-10,1);
        if($ll != 15){ 
            dd("Invalid CNIC length....Please enter another CNIC No");
        } elseif($dd1 != "-" OR $dd2 != "-"){
            dd("Illegel CNIC formate....Please enter another CNIC No.");

        } 
       

        // for registration number 
        $ses = $data['Session'];

        $yr = SUBSTR($ses,2,2);

        $query = "SELECT * FROM serialno".$yr." WHERE id=1";
        
        $query_result[0][0] = DB::select($query);
        $no= $query_result[0][0][0]->sNo;
        $no = $no + 1;
        $stno = "".$no;

        if(strlen($stno) == 1){
           $serno = "00000".$stno;
       } else if(strlen($stno) == 2){
           $serno = "0000".$stno;
       } else if(strlen($stno) == 3){
           $serno = "000".$stno;
       } else if(strlen($stno) == 4){
           $serno = "00".$stno;
       } else if(strlen($stno) == 5){
           $serno = "0".$stno;
       }

         $registration_no = $centre_code.'-'.'S'.$ses.'-'.$serno;

        // for registration number 

       $data=array(
        "ses_name"=>$student_data['Session'],
        "ses_anl_sup"=>$student_data['AnualSuply'],
        "ses_cnt_code"=>$centre_code,
        "ses_group"=>$student_data['GroupShift'],
        "ses_dur"=>$student_data['CourseDuration'],
        "ses_serial_no"=>$student_data['SerialNo'],
        "ses_cnic_no"=>$student_data['StudentCNICNo'],
        "ses_sex"=>$student_data['SelectGender'],
        "ses_st_name"=>$student_data['StudentName'],
        "ses_f_name"=>$student_data['FatherName'],
        "ses_st_doa"=>$student_data['DateofAdmission'],
        "ses_st_dob"=>$student_data['DateofBirth'],
        "ses_trade_name"=>$student_data['SelectTrade'],
        "ses_trade_code"=>$student_data['EnterTradeCode'],
        "ses_roll_no"=>$student_data['CollegeRollNo'],
        "ses_status"=>$student_data['status'],
        "ses_qual_code"=>$student_data['qualCode'],
        "ses_reg_no"=>$registration_no,
        "userId"=>$student_data['userId'],
        "ses_chance"=>$student_data['alowreg'],
        "ses_alow_reg"=>$student_data['chance'],
        "ses_examTitle"=>$student_data['ExamTitle'],
        "ses_pic_name"=>$image_name,
    );

       $session_table = 'ses'.$student_data['Session'];
       $checkinsert=DB::table($session_table)->where('ses_cnic_no', $student_data['StudentCNICNo'])->update($data);
       DB::statement("UPDATE serialno".$yr." SET sNo=".$no ); 
       return  "'success', 'Student has been  updated Sucessfully!'"; 
   }

    public function enterStudentSession(Request $request)
    {  
        $data['Session'] = $request->session;
       $data['trades']    = Trades::all();
       $data['Group']     = Group::all();
       $data['Centres']   = Centres::all();
       $data['ExamTitle'] = ExamTitle::all();
       $data['QualCode']  = QualCodes::all();
       // $query             = "Select * from seshis";
       // $data['Session']   = DB::select($query);
       

       return view('Data_module.enterStudentSession',compact('data'));
    }


        protected function sessionToAddStudent(Request $request)
    {

        $request->EnterDate = Carbon\Carbon::parse($request->EnterDate)->format('y-m-d');
        $data['Session']        =$request->EnterSession;
        $data['CentreCode']     =$request->CentreCode;
        $data['SelectCentre']   =$request->SelectCentre;
        $data['EnterTradeCode'] =$request->EnterTradeCode;
        $data['SelectGroup']    =$request->SelectGroup;
        $data['EnterDate']      =$request->EnterDate;
        $data['AnualSuply']     =$request->AnualSuply;
        $data['CourseDuration'] =$request->CourseDuration;
        $data['ExamTitle']      =$request->ExamTitle;
        $data['SelectTrade']    =$request->SelectTrade;


        return view('Data_module.addStudent',compact('data'));

    }



        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editStudent($studentCNIC,$session)
    {
         
        $studentCNIC = \Crypt::decrypt($studentCNIC); 
        $session     = \Crypt::decrypt($session); 
        $table_name  = "ses".$session;
        // $query       = "SELECT * FROM ".$table_name." WHERE ses_cnic_no = '$studentCNIC'";
        $query       = "SELECT * FROM ".$table_name;

        $query_result = DB::select($query);
        $studentData = $query_result[0];
        // dd($studentData);
        return view('Data_module.editStudent',compact('studentData'));
        
    }


         public function submitStudentData()
    {
        return view('Data_module.submitStudentData');

    }

    public function studentDataSubmit(Request $request)
    {


    $session = $request->session;
    $querymain = "Select * from ses".$session;
    $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);

    if($checkTable == false){
       return  "'failure', 'Session  not exist'"; 
   }

    $session_student = DB::select($querymain.' where 1=1 ');
    if(empty($session_student)){
       return  "'failure', 'Session is empty '"; 

    }
   
    foreach ($session_student as $key => $student_data){

       $data=array(
        "mas_session1"=>$student_data->ses_name,
        "mas_anl_sup"=>$student_data->ses_anl_sup,
        "mas_cnt_code"=>$student_data->ses_cnt_code,
        "mas_group"=>$student_data->ses_group,
        "mas_dur"=>$student_data->ses_dur,
        "mas_serial_no"=>$student_data->ses_serial_no,
        "mas_cnic_no"=>$student_data->ses_cnic_no,
        "mas_sex"=>$student_data->ses_sex,
        "mas_st_name"=>$student_data->ses_st_name,
        "mas_f_name"=>$student_data->ses_f_name,
        "mas_st_doa"=>$student_data->ses_st_doa,
        "mas_st_dob"=>$student_data->ses_st_dob,
        "mas_trade_name"=>$student_data->ses_trade_name,
        "mas_trade_code"=>$student_data->ses_trade_code,
        "mas_roll_no"=>$student_data->ses_roll_no,
        //"mas_status"=>$student_data->ses_status,
        "mas_qual_code"=>$student_data->ses_qual_code,
        "mas_reg_no"=>$student_data->ses_reg_no,
        "userID"=>$student_data->userID,
        "mas_chance"=>$student_data->ses_chance,
        "mas_alow_reg"=>$student_data->ses_alow_reg,
        "mas_examTitle"=>$student_data->ses_examTitle,
        "mas_mks_th"=>$student_data->ses_mks_th,
        "mas_mks_pr"=>$student_data->ses_mks_pr,
        "mas_th_pass"=>$student_data->ses_th_pass,
        "mas_pr_pass"=>$student_data->ses_pr_pass,
        //"ses_pic_name"=>$imageName,
    );  
    $session     = $data['mas_session1'];
    $studentCNIC = $data['mas_cnic_no'];
    $studentName = $data['mas_st_name'];
    $mas_reg_no  = $data['mas_reg_no'];
       
    $querymain = "SELECT * FROM allstudents WHERE session = '$session' AND student_cnic = '$studentCNIC'";
    $studentInfo = DB::select($querymain);
    if(empty($studentInfo)){
        $checkinsert=DB::table('allstudents')->insert(['session'=>$session,
               'student_cnic'=>$studentCNIC,
               'student_name'=>$studentName,
               'reg_no'      =>$mas_reg_no
        ]);

        $mass_table = 'masterfile22';
        $checkinsert=DB::table($mass_table)->insert($data); 
       
       }else{

        return  "'failure', '$studentCNIC' Already Exist In '$session'"; 

        }
   
    $session_table= 'ses'.$student_data->ses_name;
    //DB::statement("UPDATE ".$session_table." SET ses_submit=1" ); 
    $checkinsert=DB::table($session_table)->where('ses_cnic_no', $studentCNIC)->update(['ses_submit'=>1]);
    }
    return  "'success', 'Students has been  Submitted to Admin  Sucessfully!'"; 

    }

        public function sessioninformation()
    {
        return view('Data_module.sessioninformation');

    }
    


    public function AllStudentList(Request $request)
    {

      $query = '';
      $session = $request->session;
      session(['session' => $session]);
      if ($request->session()->has('session')) {
        $session =  session('session');
    } 
    if($request->has('SelectCentre'))
    {
        $group =$request->SelectGroup;
        $trade =$request->SelectTrade; 
        $centreCode = $request->SelectCentre; 
        $query .= " and ses_cnt_code = '$centreCode'";
        $query .= " and ses_group = '$group'"; 
        $query .= " and ses_trade_name = '$trade'";
    }
     $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);

        if($checkTable == false){
           return  "'failure', 'Session not exist'"; 
       }

    
    $querymain = "Select * from ses".$session;
    $students = DB::select($querymain.' where 1=1 '.$query);
    return view('Data_module.allStudentList',compact('students','session'));

    }

       public function editStudentByAdmin($studentCNIC,$session)
    {
         
        $studentCNIC = \Crypt::decrypt($studentCNIC); 
        $session     = \Crypt::decrypt($session); 
        $table_name  = "ses".$session;
        $query       = "SELECT * FROM ".$table_name." WHERE ses_cnic_no = '$studentCNIC'";
        $query_result = DB::select($query);
        $studentData = $query_result[0];
        return view('Data_module.editStudentByAdmin',compact('studentData'));
        
    }

       protected function updateStudentByAdmin(Request $request)
    {
        

        $request->validate([
            // 'email' => ['required',  'unique:users,email,'.$request->id],
            'Session' => ['required', 'string', 'max:255'],
            'AnualSuply' => ['required', 'string', 'max:255'],
            'Centre' => ['required', 'string', 'max:255'],
            'GroupShift' => ['required', 'string', 'max:255'],
            'CourseDuration' => ['required', 'string', 'max:255'],
            'ExamTitle' => ['required', 'string', 'max:255'],
            'EnterTradeCode' => ['required', 'string', 'max:255'],
            'SelectTrade' => ['required', 'string', 'max:255'],
            'SerialNo' => ['required', 'string', 'max:255'],
            'CollegeRollNo' => ['required', 'string', 'max:255'],
            'SelectGender' => ['required', 'string', 'max:255'],
            'StudentCNICNo' => ['required', 'string', 'max:255'],
            'StudentName' => ['required', 'string', 'max:255'],
            'FatherName' => ['required', 'string', 'max:255'],
            'DateofAdmission' => ['required', 'string', 'max:255'],
            'DateofBirth' => ['required', 'string', 'max:255'],
            'SelectQualification' => ['required', 'string', 'max:255'],

        ]);;

        $userId = Auth::user()->id;
        $request->DateofAdmission = Carbon\Carbon::parse($request->DateofAdmission)->format('y-m-d');
        $request->DateofBirth = Carbon\Carbon::parse($request->DateofBirth)->format('y-m-d');
        $now = Carbon\Carbon::now();
        $datelessthan18 = strtotime($now.'-18 year');
        $dob = strtotime($request->DateofBirth);
        if($dob>= $datelessthan18){
            return  "'failure', 'Student Age is less then 18 years!'"; 

        }else{

        } 
        $data['userId']              = $userId;  
        $data['Session']             = $request->Session;
        $data['AnualSuply']          = $request->AnualSuply;
        $data['Centre']              = $request->Centre;
        $data['GroupShift']          = $request->GroupShift;
        $data['CourseDuration']      = $request->CourseDuration;
        $data['ExamTitle']           = $request->ExamTitle;
        $data['SerialNo']            = $request->SerialNo;
        $data['SelectGender']        = $request->SelectGender;
        $data['StudentCNICNo']       = $request->StudentCNICNo;
        $data['StudentName']         = $request->StudentName;
        $data['FatherName']          = $request->FatherName;
        $data['DateofAdmission']     = $request->DateofAdmission;
        $data['DateofBirth']         = $request->DateofBirth;
        $data['SelectTrade']         = $request->SelectTrade;
        $data['EnterTradeCode']      = $request->EnterTradeCode;
        $data['SelectQualification'] = $request->SelectQualification;
        $data['CollegeRollNo']       = $request->CollegeRollNo;
        $data['DateofAdmission']     = $request->DateofAdmission;
        $data['DateofBirth']         = $request->DateofBirth;
        $data['SelectQualification'] = $request->SelectQualification;
        $data['status']              = isset($request->status) ? 'active' : 'inactive';
        $qual_name                   = $data['SelectQualification'];
        $query                       = QualCodes::where(['qualName' => $qual_name])->first();
        $qualCode                    = $query['qualCode'];
        $data['qualCode']            = $qualCode;
        $data['alowreg']             = 1;
        $data['chance']              = 1;

        //$imageName                 = time().'.'.$request->image->extension(); 
        //$data['image']             = $request->image->move(public_path('images'), $imageName);
        Session::put('student_data', $data);
        $student_data= Session::get('student_data');

        // Centre code 
        $centre_code = substr($request->Centre, 0, 4);
       
        // CNIC Validation 
        $cnicno = $data['StudentCNICNo'];
        $ll=strlen($cnicno);
        $dd1=substr($cnicno,-2,1);
        $dd2=substr($cnicno,-10,1);
        if($ll != 15){ 
            dd("Invalid CNIC length....Please enter another CNIC No");
        } elseif($dd1 != "-" OR $dd2 != "-"){
            dd("Illegel CNIC formate....Please enter another CNIC No.");

        } 
       
        // for registration number 
       //  $ses = $data['Session'];
       //  $yr = SUBSTR($ses,2,2);
       //  $query = "SELECT * FROM serialno".$yr." WHERE id=1";
       //  $query_result[0][0] = DB::select($query);
       //  $no= $query_result[0][0][0]->sNo;
       //  $no = $no + 1;
       //  $stno = "".$no;

       //  if(strlen($stno) == 1){
       //     $serno = "00000".$stno;
       // } else if(strlen($stno) == 2){
       //     $serno = "0000".$stno;
       // } else if(strlen($stno) == 3){
       //     $serno = "000".$stno;
       // } else if(strlen($stno) == 4){
       //     $serno = "00".$stno;
       // } else if(strlen($stno) == 5){
       //     $serno = "0".$stno;
       // }
       // $registration_no = $centre_code.'-'.'S'.$ses.'-'.$serno;
       // for registration number 

       $data=array(
        "ses_name"=>$student_data['Session'],
        "ses_anl_sup"=>$student_data['AnualSuply'],
        "ses_cnt_code"=>$centre_code,
        "ses_group"=>$student_data['GroupShift'],
        "ses_dur"=>$student_data['CourseDuration'],
        "ses_serial_no"=>$student_data['SerialNo'],
        "ses_cnic_no"=>$student_data['StudentCNICNo'],
        "ses_sex"=>$student_data['SelectGender'],
        "ses_st_name"=>$student_data['StudentName'],
        "ses_f_name"=>$student_data['FatherName'],
        "ses_st_doa"=>$student_data['DateofAdmission'],
        "ses_st_dob"=>$student_data['DateofBirth'],
        "ses_trade_name"=>$student_data['SelectTrade'],
        "ses_trade_code"=>$student_data['EnterTradeCode'],
        "ses_roll_no"=>$student_data['CollegeRollNo'],
        "ses_status"=>$student_data['status'],
        "ses_qual_code"=>$student_data['qualCode'],
        //"ses_reg_no"=>$registration_no,
        "userId"=>$student_data['userId'],
        "ses_chance"=>$student_data['alowreg'],
        "ses_alow_reg"=>$student_data['chance'],
        "ses_examTitle"=>$student_data['ExamTitle'],
        //"ses_pic_name"=>$imageName,
    );
       // dd($request);
     $masData=array(
        "mas_session1"=>$student_data['Session'],
        "mas_anl_sup"=>$student_data['AnualSuply'],
        "mas_cnt_code"=>$student_data['Centre'],
        "mas_group"=>$student_data['GroupShift'],
        "mas_dur"=>$student_data['CourseDuration'],
        "mas_serial_no"=>$student_data['SerialNo'],
        "mas_cnic_no"=>$student_data['StudentCNICNo'],
        "mas_sex"=>$student_data['SelectGender'],
        "mas_st_name"=>$student_data['StudentName'],
        "mas_f_name"=>$student_data['FatherName'],
        "mas_st_doa"=>$student_data['DateofAdmission'],
        "mas_st_dob"=>$student_data['DateofBirth'],
        "mas_trade_name"=>$student_data['SelectTrade'],
        "mas_trade_code"=>$student_data['EnterTradeCode'],
        "mas_roll_no"=>$student_data['CollegeRollNo'],
        //"mas_status"=>$student_data->ses_status,
        "mas_qual_code"=>$student_data['SelectQualification'],
       //"mas_reg_no"=>$student_data['ses_reg_no'],
        "userID"=>$student_data['userId'],
        "mas_chance"=>$student_data['chance'],
        "mas_alow_reg"=>$student_data['alowreg'],
        "mas_examTitle"=>$student_data['ExamTitle'],
        //"ses_pic_name"=>$imageName,
    );  
      
       $session_table = 'ses'.$student_data['Session'];
       $checkinsert=DB::table($session_table)->where('ses_cnic_no', $student_data['StudentCNICNo'])->update($data);
       $checkinsert=DB::table('masterfile22')->where('mas_cnic_no', $student_data['StudentCNICNo'])->update($masData);


       //DB::statement("UPDATE serialno".$yr." SET sNo=".$no ); 
       return  "'success', 'Student has been  updated Sucessfully!'"; 
   }



//Student Attendence 

   public function studentAttendence()
    {
     return view('Data_module.studentAttendence');
    }


   public function attendenceStudent(Request $request)
    {
     $session = $request->session;
     $checkinsert=DB::table('masterfile22')->where('mas_session1', $session)->update(['mas_att_per'=>'P',
     'mas_att_th1'=>'P',
     'mas_att_pr1'=>'P']);
     return  "'success', 'Attendence Marked Sucessfully!'"; 
    // return view('Data_module.studentAttendence');
    }


    //Student Result 

     public function enterStudentResult()
    {
     return view('Data_module.enterStudentResult');
    }

     public function studentResult(Request $request)
    {
        $session = $request->session;
        $query       = "SELECT * FROM masterfile22 WHERE mas_session1 = '$session'";
        $query_result = DB::select($query);
        $studentData = $query_result;
        if($studentData){
        return view('Data_module.studentResult',compact('studentData'));
        }else{
        return  "'success', 'Session Does Not Exist'"; 

        }
        

     
    }

       public function submitStudentResult(Request $request)
    {
        //dd($request);
       $count = $request->StudentRegistration;
       $index_count = sizeof($count);
       $student_data = array();

        for ($i=0; $i < $index_count ; $i++) { 
        $rawdata = array();
        $rawdata['centre']              = $request->centre[$i];
        $rawdata['group']               = $request->group[$i];
        $rawdata['StudentRegistration'] = $request->StudentRegistration[$i];
        $rawdata['studentName']         = $request->StudentName[$i];
        $rawdata['theoryAttendence']    = $request->TheoryAttendence[$i];
        $rawdata['thoeryMarks']         = $request->TheoryMarks[$i];
        $rawdata['PracticalAttendence'] = $request->PracticalAttendence[$i];
        $rawdata['PracticalMarks']      = $request->PracticalMarks[$i];
        $rawdata['Remarks']             = $request->Remarks[$i];

        $student_data[$i]               = $rawdata;
        
        } 
        //dd($student_data);
        foreach($student_data as $data){
            
            $StudentRegistration = $data['StudentRegistration'];
            $theoryAttendence    = $data['theoryAttendence'];
            $thoeryMarks         = $data['thoeryMarks'];
            $PracticalAttendence = $data['PracticalAttendence'];
            $PracticalMarks      = $data['PracticalMarks'];
            $Remarks             = $data['Remarks'];
            $total_marks         = $thoeryMarks + $PracticalMarks;

            $checkinsert=DB::table('masterfile22')->where('mas_reg_no', $StudentRegistration)->update(['mas_att_per'=>$PracticalAttendence,
               'mas_att_th1'=>$theoryAttendence,
               'mas_th_obt1'=>$thoeryMarks,
               'mas_pr_obt1'=>$PracticalMarks,
               'mas_remarks1'=>$Remarks,
               'mas_result1'=>$total_marks

           ]);
          }
     
     
         return  "'success', 'Marks Added Sucessfully!'";
    }

    



    public function demourl()
    {
         return view('Data_module.demourl');
    }
}
