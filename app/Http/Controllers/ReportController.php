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

class ReportController extends Controller
{

   public function __construct()
   {
    $this->middleware('auth');
}
  
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function strengthSummary()
    {
        return view('Reports/strengthSummary');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sessionHistoryReport()
    {
        $querymain = "Select * from seshis";
        $seshistories = DB::select($querymain);
        
        return view('Reports/sessionHistoryReport',compact('seshistories'));
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function registrationAllottedReport()
      {
          return view('Reports/registrationAllottedReport');
      }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function sceAttendenceSheet()
        {
            return view('Reports/sceAttendenceSheet');
        }


        public function pictureListStudentReport(Request $request)
        {
            $query = '';
            $students = '';
            $student_data = '';
            $session = $request->session;  
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
               $query .= " and ses_trade_code = '$trade'";
           }
           $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);
           if($checkTable == false){
            return  "'failure', 'Session not exist'"; 
           }
            $querymain = "Select * from ses".$session;

            $students = DB::select($querymain.' where 1=1 '.$query);
            if($students){
               $student_data = $students;
           }

       return view('Reports/pictureListStudentReport',compact('student_data'));
   }
         /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
         public function strengthSummaryReport()
         {
          return view('Reports/strengthSummaryReport');
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function editingDataForm()
    {
        return view('Reports/editingDataForm');
    }

    public function editingDatalistReport(Request $request)
    {
      
       $query = '';
       $students = '';
       $student_data = '';
       $session = $request->session;  
       if($request->has('CentreCode'))
       {
        $centreCode = $request->CentreCode; 
        $query .= " and mas_cnt_code = '$centreCode'";
       }

       if($request->has('SelectCentre'))
       {
        
        $centre = $request->SelectCentre; 
        $centre_code = substr($centre, 0, 4);
        $query .= " and mas_cnt_code = '$centreCode'";
       }


        if($request->has('SelectGroup'))
        {
            $group =$request->SelectGroup;
            $query .= " and mas_group = '$group'";  
        }
            $query .= " and mas_session1 = '$session'";  
        
         $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);
         if($checkTable == false){
            return  "'failure', 'Session not exist'"; 
        }
        // $querymain = "Select * from ses".$session;
        $querymain = "Select * from masterfile22";



        $students = DB::select($querymain.' where 1=1 '.$query);
        if($students){
         $student_data = $students;
        }
      //  dd($student_data);

       return view('Reports/editingDatalistReport',compact('student_data'));
     }





      public function admitanceSlipForm()
    {
        return view('Reports/admitanceSlipForm');
    }


     public function admitanceSlipReport(Request $request)
    {
      
       $query = '';
       $students = '';
       $student_data = '';
       $session = $request->session;  
       if($request->has('CentreCode'))
       {
        $centreCode = $request->CentreCode; 
        $query .= " and ses_cnt_code = '$centreCode'";
       }

       if($request->has('SelectCentre'))
       {
        
        $centre = $request->SelectCentre; 
        $centre_code = substr($centre, 0, 4);
        $query .= " and ses_cnt_code = '$centreCode'";
       }
         if($request->has('SelectTrade'))
        {
            $trade =$request->SelectTrade;
            $query .= " and ses_trade_code = '$trade'";  
        }

        if($request->has('SelectGroup'))
        {
            $group =$request->SelectGroup;
            $query .= " and ses_group = '$group'";  
        }

        //   if($request->has('SelectType'))
        // {
        //     $type =$request->SelectType;
        //     $query .= " and ses_group = '$type'";  
        // }

         $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);
         if($checkTable == false){
            return  "'failure', 'Session not exist'"; 
        }
        $querymain = "Select * from ses".$session;


        $students = DB::select($querymain.' where 1=1 '.$query);
        if($students){
         $student_data = $students;
        }

      // return view('Reports/editingDatalistReport',compact('student_data'));
     }




        public function attendenceSheetForm()
    {
        return view('Reports/attendenceSheetForm');
    }


     public function attendenceSheetReport(Request $request)
    {

       $query = '';
       $students = '';
       $student_data = '';
       $session = $request->session;  
       if($request->has('CentreCode'))
       {
        $centreCode = $request->CentreCode; 
        $query .= " and ses_cnt_code = '$centreCode'";
       }

       if($request->has('SelectCentre'))
       {
        
        $centre = $request->SelectCentre; 
        $centre_code = substr($centre, 0, 4);
        $query .= " and ses_cnt_code = '$centreCode'";
       }
         if($request->has('SelectTrade'))
        {
            $trade =$request->SelectTrade;
            $query .= " and ses_trade_code = '$trade'";  
        }

        if($request->has('SelectGroup'))
        {
            $group =$request->SelectGroup;
            $query .= " and ses_group = '$group'";  
        }

        //   if($request->has('SelectType'))
        // {
        //     $type =$request->SelectType;
        //     $query .= " and ses_group = '$type'";  
        // }

         $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);
         if($checkTable == false){
            return  "'failure', 'Session not exist'"; 
        }
        $querymain = "Select * from ses".$session;


        $students = DB::select($querymain.' where 1=1 '.$query);
        if($students){
         $student_data = $students;
        }

      // return view('Reports/editingDatalistReport',compact('student_data'));
     }





   public function awardListForm()
    {
        return view('Reports/awardListForm');
    }


     public function awardListReport(Request $request)
    {
       $query = '';
       $students = '';
       $student_data = '';
       $session = $request->session;  
       if($request->has('CentreCode'))
       {
        $centreCode = $request->CentreCode; 
        $query .= " and ses_cnt_code = '$centreCode'";
       }

       if($request->has('SelectCentre'))
       {
        
        $centre = $request->SelectCentre; 
        $centre_code = substr($centre, 0, 4);
        $query .= " and ses_cnt_code = '$centreCode'";
       }
         if($request->has('SelectTrade'))
        {
            $trade =$request->SelectTrade;
            $query .= " and ses_trade_code = '$trade'";  
        }

        if($request->has('SelectGroup'))
        {
            $group =$request->SelectGroup;
            $query .= " and ses_group = '$group'";  
        }

        //   if($request->has('SelectType'))
        // {
        //     $type =$request->SelectType;
        //     $query .= " and ses_group = '$type'";  
        // }

        //   if($request->has('Date'))
        // {
        //     $Date =$request->Date;
        //     $query .= " and ses_group = '$Date'";  
        // }

         $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);
         if($checkTable == false){
            return  "'failure', 'Session not exist'"; 
        }
        $querymain = "Select * from ses".$session;


        $students = DB::select($querymain.' where 1=1 '.$query);
        if($students){
         $student_data = $students;
        }

      // return view('Reports/editingDatalistReport',compact('student_data'));
     }




      public function resultStatementForm()
    {
        return view('Reports/resultStatementForm');
    }


     public function resultStatementReport(Request $request)
    {
       $query = '';
       $students = '';
       $student_data = '';
       $session = $request->session;  
       if($request->has('CentreCode'))
       {
        $centreCode = $request->CentreCode; 
        $query .= " and ses_cnt_code = '$centreCode'";
       }

       if($request->has('SelectCentre'))
       {
        
        $centre = $request->SelectCentre; 
        $centre_code = substr($centre, 0, 4);
        $query .= " and ses_cnt_code = '$centreCode'";
       }
         if($request->has('SelectTrade'))
        {
            $trade =$request->SelectTrade;
            $query .= " and ses_trade_code = '$trade'";  
        }

        if($request->has('SelectGroup'))
        {
            $group =$request->SelectGroup;
            $query .= " and ses_group = '$group'";  
        }
         if($request->has('CopyType'))
        {
            $CopyType =$request->CopyType;
            
        }
    

         $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);
         if($checkTable == false){
            return  "'failure', 'Session not exist'"; 
        }
        $querymain = "Select * from ses".$session;


        $students = DB::select($querymain.' where 1=1 '.$query);
        if($students){
         $student_data = $students;
        }

       return view('Reports/resultStatementReport',compact('student_data'));
     }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function centerSummaryForm()
        {
          return view('Reports/centerSummaryForm');
      }


    public function centerReport(Request $request)
    {
       $query = '';
       $students = '';
       $student_data = '';
       $session = $request->session;  
       if($request->has('CentreCode'))
       {
        $centreCode = $request->CentreCode; 
        $query .= " and ses_cnt_code = '$centreCode'";
       }

       if($request->has('SelectCentre'))
       {
        
        $centre = $request->SelectCentre; 
        $centre_code = substr($centre, 0, 4);
        $query .= " and ses_cnt_code = '$centreCode'";
       }
         if($request->has('SelectTrade'))
        {
            $trade =$request->SelectTrade;
            $query .= " and ses_trade_code = '$trade'";  
        }

        if($request->has('SelectGroup'))
        {
            $group =$request->SelectGroup;
            $query .= " and ses_group = '$group'";  
        }
         if($request->has('CopyType'))
        {
            $CopyType =$request->CopyType;
            
        }
    

         $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);
         if($checkTable == false){
            return  "'failure', 'Session not exist'"; 
        }
        $querymain = "Select * from ses".$session;


        $students = DB::select($querymain.' where 1=1 '.$query);
        if($students){
         $student_data = $students;
        }
        return view('Reports/centerReport',compact('student_data'));
    }
  
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
          public function printCertificateForm()
       {
                return view('Reports/printCertificateForm');
      }


       public function printCertificateReport(Request $request)
       {

       $query = '';
       $students = '';
       $student_data = '';
       $session = $request->session;  
       if($request->has('CentreCode'))
       {
        $centreCode = $request->CentreCode; 
        $query .= " and ses_cnt_code = '$centreCode'";
       }

       if($request->has('SelectCentre'))
       {
        
        $centre = $request->SelectCentre; 
        $centre = substr($centre, 0, 4);
        $query .= " and ses_cnt_code = '$centre'";
       }
         if($request->has('ExamTitles'))
        {
            $ExamTitles =$request->ExamTitles;
            $query .= " and ses_examTitle = '$ExamTitles'";  
        }

        if($request->has('SelectGroup'))
        {
            $group =$request->SelectGroup;
            $query .= " and ses_group = '$group'";  
        }
         if($request->has('CertificateDate'))
        {
            $CertificateDate =$request->CertificateDate;
            $query .= " and ses_st_doa = '$CertificateDate'";  
            
        }
    
        
         $checkTable  = DB::getSchemaBuilder()->hasTable('ses'.$session);
         if($checkTable == false){
            return  "'failure', 'Session not exist'"; 
        }
        $querymain = "Select * from ses".$session;

        $students = DB::select($querymain.' where 1=1 '.$query);

        if($students){
         $student_data = $students;
        }

          return view('Reports/printCertificateReport',compact('student_data'));
      }

      

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function sessionHistoryStatisticalReport()
        {
          return view('Reports/sessionHistoryStatisticalReport');
      }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
