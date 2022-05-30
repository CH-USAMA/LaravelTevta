@extends('layouts.main')
@section('title', 'Student Information Show')
@section('content')


<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
      <span>Home</span>
      </li>
      <li class="breadcrumb-item active"><span>Student</span></li>
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
$session_status = '';
if($students){
  
 $session_status = $students[0]->ses_submit; 
}
@endphp


<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="card mb-4">
          <form action="{{ url('sessionStudentList')}}" method="POST" >
            @csrf
            <input type="hidden" name="table" value="session">
            
            <div class="card-header">List of Students
               @if($session_status != 1) 
             <a href="{{ url('enterStudentSession/'.$session.'/')}}" class="btn btn-secondary" style="float:right;">Add Student</a>
             @endif
             <br><br>
             <div class="row">

             <div class="col-md-2">
               <label class="form-label" for="role">Session</label>
                   <select name="EnterSession" class="form-select @error('EnterSession') is-invalid @enderror" required id="EnterSession">
                  <option disabled= selected>Choose...</option>
                  
                  <option value="{{$session}}">{{$session}}</option>
                 
                  
                </select>
            </div>
            <input type="hidden" name="session" value="{{ $session ?? ''}}">
            <div class="col-md-2">
              <label class="form-label" for="role">Centre</label>
                  <select name="SelectCentre" class="form-select @error('SelectCentre') is-invalid @enderror" required id="SelectCentre">
                  <option disabled selected>Choose...</option>
                  @foreach($Centres as $Centre)
                  <option value="{{$Centre->centreCode}}">{{$Centre->centreName}}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-2">
              <label class="form-label" for="role">Group</label>
               <select name="SelectGroup" class="form-select @error('SelectGroup') is-invalid @enderror" required id="SelectGroup">
                  <option disabled selected>Choose...</option>
                  @foreach($Groups as $Group)
                  <option value="{{$Group->groupName}}">{{$Group->groupName}}</option>
                  @endforeach
                  
                </select>
            </div>
            <div class="col-md-2">
              <label class="form-label" for="role">Trades</label>
               <select name="SelectTrade" class="form-select @error('SelectTrade') is-invalid @enderror" required id="SelectTrade">
                  <option disabled selected>Choose...</option>
                  @foreach($Trades as $Trade)
                  <option value="{{$Trade->tradeName}}">{{$Trade->tradeName}}</option>
                  @endforeach
                  
                </select>
            </div>

          </div>
          <button type="submit" class="btn btn-secondary  col-md-2" style="float:right;">Apply</button>
          <br><br>


          </div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                    <th></th>
                    <th>Nr</th>
                    <th>CNIC NO.</th>
                    <th>Registration No.</th>
                    <th>Students Name</th>
                    <th>Fathers Name</th>
                    <th>Centre Code</th>
                    <th>Trade Name</th>
                    <th>D.O.B</th>
                    <th>Alow Reg</th>
                    <th>Group/SHift</th>

                  </tr>
                </thead>
                <tbody>

                  
                  @foreach($students as $student)
                   
                    <tr>
                      @if($student->ses_submit != 1) 
                    <td><input type="checkbox" name="delete[]"  value="{{ $student->id}}" /></td>
                    @else
                    <td></td>
                    @endif
                    <th>{{$student->id}}</th>

                    @if($student->ses_submit == 1) 
                    <td>{{ $student->ses_cnic_no}}</td>        

                    @else
                    <td><a href="{{ route('editStudent',['ses_cnic_no' => Crypt::encrypt($student->ses_cnic_no) ,'session' => Crypt::encrypt($student->ses_name)])}}">{{ $student->ses_cnic_no}}</a></td>       
                    @endif
                  
                    <td>{{ $student->ses_reg_no}}</td>
                    <td>{{ $student->ses_st_name}}</td>
                    <td>{{ $student->ses_f_name}}</td>
                    <td>{{ $student->ses_cnt_code}}</td>
                    <td>{{ $student->ses_trade_name}}</td>
                    <td>{{ $student->ses_st_dob}}</td>
                      <td> <input data-id="{{$student->id}}" class="changeStatus" type="checkbox" data-onstyle="success" data-offstyle="danger"
                     data-toggle="toggle" data-on="Active" data-off="InActive" {{ $student->id ? 'checked' : '' }}></td>
                    <td>{{ $student->ses_group}}</td>
                  
                  </tr>

                 
                
          
                  </form>
                  @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
  </div>
</div> 

@endsection

@section('javascript')

  $(document).ready(function() {
      $('#example').DataTable({
        "scrollX": true
      });
  } );

$(function() {
    $('.changeStatus').change(function() {
        var status = $(this).prop('checked') == true ? active : inactive; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatusUser',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
              toastr.info("Status changed Successfully");
            }
        });
    })
  })
@endsection

