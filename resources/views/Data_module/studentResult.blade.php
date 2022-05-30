@extends('layouts.main')

@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Enter</span>
      </li>
      <li class="breadcrumb-item active"><span>Student Result</span></li>
    </ol>
  </nav>
</div>
</header>

@php
$Groups     = App\Models\Group::get();
$Trades     = App\Models\Trades::get();
$Centres    = App\Models\Centres::get();
$ExamTitles = App\Models\ExamTitle::get();
$QualCodes  = App\Models\QualCodes::get();
$SessionHistories = App\Models\SessionHistory::get();
$centreName = App\Models\Centres::where(['centreCode' => $studentData[0]->mas_cnt_code])->first();

@endphp



<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <!-- <div class="row"> -->
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="card mb-4">
            <div class="card-header">Enter Session</div>
            <div class="card-body">
               
              <form class="row g-3" method="POST" action="{{url('submit_student_result')}}">
               @csrf
                <input type="hidden" id="session" name="session" value="{{$studentData[0]->mas_session1}}">
                @foreach($studentData as $student)
               <div class="col-md-6">
                <label class="form-label" for="centre">Centre</label>
                <input class="form-control @error('centre') is-invalid @enderror" id="centre" type="input" name="centre[]"  value="{{$centreName->centreName}}" readonly>
              </div>
                <div class="col-md-6">
                <label class="form-label" for="group">Group</label>
                <input class="form-control @error('group') is-invalid @enderror" id="group" type="input" name="group[]"  value="{{$student->mas_group}}" readonly>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="StudentRegistration">Student Registration</label>
                <input class="form-control @error('StudentRegistration') is-invalid @enderror" id="StudentRegistration" type="input" name="StudentRegistration[]"  value="{{$student->mas_reg_no}}" readonly>
              </div>

               <div class="col-md-6">
                <label class="form-label" for="StudentName">Student Name</label>
                <input class="form-control @error('StudentName') is-invalid @enderror" id="StudentName" type="input" name="StudentName[]"  value="{{$student->mas_st_name}}" readonly>
              </div>


              
               <div class="col-md-6">
                <label class="form-label" for="TheoryAttendence">Theory Attendence</label>
                <input class="form-control @error('TheoryAttendence') is-invalid @enderror" id="TheoryAttendence" type="input" value="{{$student->mas_att_th1}}"  name="TheoryAttendence[]" >
              </div>
               <div class="col-md-6">
                <label class="form-label" for="TheoryMarks"> Theory Marks </label>
                <input class="form-control @error('TheoryMarks') is-invalid @enderror" id="TheoryMarks" type="input"value="{{$student->mas_th_obt1}}"  name="TheoryMarks[]" >
              </div>
               <div class="col-md-6">
                <label class="form-label" for="PracticalAttendence">Practical Attendence</label>
                <input class="form-control @error('PracticalAttendence') is-invalid @enderror" id="PracticalAttendence" type="input" value="{{$student->mas_att_per}}" name="PracticalAttendence[]" >
              </div>
               <div class="col-md-6">
                <label class="form-label" for="PracticalMarks">Practical Marks</label>
                <input class="form-control @error('PracticalMarks') is-invalid @enderror" id="PracticalMarks" type="input"  value="{{$student->mas_pr_obt1}}"name="PracticalMarks[]" >
              </div>
               <div class="col-md-6">
                <label class="form-label" for="Remarks">Remarks</label>
                <input class="form-control @error('Remarks') is-invalid @enderror" id="Remarks" type="input"  value="{{$student->mas_remarks1}}"name="Remarks[]" >
              </div>
          
              
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             <div></div>
             
               @endforeach
               <div class="col-12">
                <button class="btn btn-primary" type="submit">OK</button>
                <button class="btn btn-primary" type="reset">Back</button>

              </div>
            </form>
             
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
  @endsection