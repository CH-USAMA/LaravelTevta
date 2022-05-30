
@extends('layouts.main')

@section('content')
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  background-color: #e3e3dc;
  /* width: auto;
    margin-right: 263px;
    margin-left: auto;*/
}

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  
}

td, th {
  border: -1px solid #dddddd;
  text-align: left;
  padding: 6px;
}


/*tr:nth-child(even) {
  background-color: #dddddd;
}*/

</style>
<style>
  * {
    box-sizing: border-box;
    }

  .row::after {
    content: "";
    clear: both;
    display: table;
  }

  [class*="col-"] {
    float: left;
    padding: 15px;
  }

  html {
    font-family: "Lucida Sans", sans-serif;
  }

  .header {
    color: black;
    padding: 15px;
  }

  .menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }

  .menu li {
    padding: 8px;
    margin-bottom: 7px;
    background-color: #33b5e5;
    color: #ffffff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  }

  .menu li:hover {
    background-color: #0099cc;
  }

  .aside {
    background-color: #33b5e5;
    padding: 15px;
    color: #ffffff;
    text-align: center;
    font-size: 14px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  }


  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }

  @media only screen and (min-width: 600px) {
    /* For tablets: */
    .col-s-1 {width: 8.33%;}
    .col-s-2 {width: 16.66%;}
    .col-s-3 {width: 25%;}
    .col-s-4 {width: 33.33%;}
    .col-s-5 {width: 41.66%;}
    .col-s-6 {width: 50%;}
    .col-s-7 {width: 58.33%;}
    .col-s-8 {width: 66.66%;}
    .col-s-9 {width: 75%;}
    .col-s-10 {width: 83.33%;}
    .col-s-11 {width: 91.66%;}
    .col-s-12 {width: 100%;}
  }
  @media only screen and (min-width: 768px) {
    /* For desktop: */
    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}
  }
</style>
</head>

@php
if($student_data){

 $centre_data      = App\Models\Centres::where(['centreCode' => $student_data[0]->mas_cnt_code])->first();
 $centre_name      = $centre_data->centreName;
 $trade_code       = $student_data[0]->mas_trade_code;
 $course_duration  = $student_data[0]->mas_dur;
 $list_group       = $student_data[0]->mas_group;
 $session_date     = App\Models\SessionHistory::where(['s_name' => $student_data[0]->mas_session1])->first();
 $session_end_date = $session_date->s_end_date;
 $sessio_name      = $student_data[0]->mas_session1;
 $session          = 'ses'.$sessio_name; 
 $trade_name       = $student_data[0]->mas_examTitle;

 $total_student = DB::select( DB::raw("SELECT COUNT(id) FROM $session "));
 $Supply_student  = DB::select( DB::raw("SELECT ses_anl_sup FROM $session WHERE ses_anl_sup = 'Suply'"));
 $SupplyStudent = COUNT($Supply_student);
 
 $Anual_student  = DB::select( DB::raw("SELECT ses_anl_sup FROM $session WHERE ses_anl_sup = 'Anual'"));
 $AnualStudent = COUNT($Anual_student);
 
 foreach($total_student[0] as $totalStudent){ 

 }

}
 
@endphp

<div class="col-md-6 col-s-12" style="text-align: center;">
  <h3>Edit list  For The Session:{{$session }}</h3>
  <h3>Trade Testing Board,Punjab,Lahore</h3>
  <h3>{{$trade_name}}</h3>
  <h5>Centre Name:{{$centre_name}}</h5>
  <h5>Shift/Group:{{$list_group}}  Duration: {{$course_duration}}Months</h5>
</div>

<table>
  <tr>
    <th><b>Sr No.</b></th>
    <th><b>Registration NO.</b></th>
    <th><b>R.NO.</b></th>
    <th><b>Gend</b></th>
    <th><b>Student's Name</b></th>
    <th><b>Father's Name</b></th>
    <th><b>Trade Name</b></th>
    <th><b>T.Code</b></th>
    <th><b>CNIC NO.</b></th>
    <th><b>D.O.B.</b></th>
    <th><b>Q.Code</b></th>
    <th><b>D.O.A</b></th>
    <th><b>Dur.</b></th>
    <th><b>Att%</b></th>
    <th><b>Remarks</b></th>
  </tr>
                 @foreach($student_data as $student)
                  <tr>
                    <th>{{$student->mas_serial_no}}</th>
                    <td>{{ $student->mas_reg_no}}</td>
                    <td>{{ $student->mas_roll_no}}</td>
                    <td>{{ $student->mas_sex}}</td>
                    <td>{{ $student->mas_st_name}}</td>
                    <td>{{ $student->mas_f_name}}</td>
                    <td>{{ $student->mas_trade_name}}</td>
                    <td>{{ $student->mas_trade_code}}</td>
                    <td>{{ $student->mas_cnic_no}}</td>
                    <td>{{ $student->mas_st_dob}}</td>
                    <td>{{ $student->mas_qual_code}}</td>
                    <td>{{ $student->mas_st_doa}}</td>
                    <td>{{ $student->mas_dur}}</td>
                    <td>80</td>
                    <td>{{ $student->mas_remarks1}}</td>
                  </tr>
                   @endforeach
  </tr>
  <tr>
    
</table>
<span><b>Total Annual Students ={{$AnualStudent}}  </b></span>
    <span><b>Total Supplementory Students = {{$SupplyStudent}} </b></span>
    <span><b>Total Students ={{$totalStudent}} </b></span>
@endsection