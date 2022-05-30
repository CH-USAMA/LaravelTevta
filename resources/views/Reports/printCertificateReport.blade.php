@extends('layouts.main')

@section('content')


<div style="width:800px; height:600px;   ">
<div style="width:800px; height:550px;   ">
       <span style="text-align:right;  padding-left:680px; font-size:15px; font-weight:bold; ">Registration_No:<u>{{$student_data[0]->ses_reg_no}}</u></span>
       <br><br>
       <span style="font-size:15px; font-weight:bold; padding-left:450px;"><i>SESSION:<u>
              {{$student_data[0]->ses_name}}</u></i></span>
       <br><br><br><br>
       <span style="font-size:15px; font-weight:bold; padding-left:150px;"><i>CERTIFIED THAT:<u>{{$student_data[0]->ses_st_name}}</u></i></span><br/><br/>
       <span style="font-size:15px; font-weight:bold; padding-left:150px;"><i>SON /DAUGHTER /WIFE OF:<u>{{ $student_data[0]->ses_f_name}}</u></i></span><br/><br/>
       <span style="font-size:15px; font-weight:bold; padding-left:150px;"><i>PARTICIPATED IN {{$student_data[0]->ses_examTitle}} MONTHS TRAINING COURSES</i></span><br/><br/>
       <span style="font-size:15px; font-weight:bold; padding-left:425px;"><i>COMPUTER APPLICATIONS</i></span><br/><br/>
       <span style="font-size:15px; font-weight:bold; padding-left:250px;"><i>AT THE <u>GOVERNMENT APPRENTICS TRAINING CENTRE FEROZWALA</u> </i></span>
       <span style="font-size:15px; font-weight:bold; padding-left:285px;"><i>HE/SHE SECURED 86% MARKES IN THE FINAL TRADE TEST </i></span>
       <span style="font-size:15px; font-weight:bold; padding-left:250px;"><i>CONDUCTED ON <u>DECEMBER 30,2021</u>BY THE TRADE TESTING BOARD </i></span><br/><br/>
       <span style="font-size:15px; font-weight:bold; padding-left:425px;"><i>IN RECOGNITION THEREOF </i>
       <span style="font-size:20px; font-weight:bold; padding-left:250px;"><i>THIS CERTIFICATE IS AWARDED ON : <u> 30.08.2021</u></i></span><br/><br/><br/>
       <span style="font-size:20px; font-weight:bold; padding-left:650px;"><i>CHAIRMAN</i></span>
       <span style="font-size:17px; font-weight:bold; padding-left:605px;"><i>TRADE TESTING BOARD</i></span>

      
   
</div>
</div>

@endsection