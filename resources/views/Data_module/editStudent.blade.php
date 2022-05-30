@extends('layouts.main')

@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Student</span>
      </li>
      <li class="breadcrumb-item active"><span>Edit</span></li>
    </ol>
  </nav>
</div>
</header>
@php
$Groups = App\Models\Group::get();
$Trades = App\Models\Trades::get();
$Centres = App\Models\Centres::get();
$ExamTitles = App\Models\ExamTitle::get();
$QualCodes = App\Models\QualCodes::get();
$SessionHistories = App\Models\SessionHistory::get();
$qual_code = App\Models\QualCodes::where(['qualCode' => $studentData->ses_qual_code])->first();
$qualName= $qual_code->qualName;
$examTitle = App\Models\ExamTitle::where(['id' => $studentData->ses_qual_code])->first();
$qualName= $qual_code->qualName;
@endphp
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <!-- <div class="row"> -->
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="card mb-4">
            <div class="card-header">Edit Student</div>
            <div class="card-body">
              <form class="row g-3" method="POST" action="{{ url('updateStudent') }}" enctype="multipart/form-data">
               @csrf
               <div class="WUIgroupList"><legend>Edit Student's Information of Session</legend></div>
             
               <div class="col-md-6">
                <label class="form-label" for="username">Session</label>
                <!-- <input name="Session" class="form-control @error('Session') is-invalid @enderror" value="{{ old('Session') }}" required autocomplete="Session" autofocus id="Session" type="text"> -->
                <select name="Session" class="form-select @error('Session') is-invalid @enderror" required id="Session">
                  <option value="{{$studentData->ses_name}}">{{$studentData->ses_name}}</option>
                </select>
                @error('Session')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
              <label class="form-label" for="role">Anual/Suply</label>
              <select name="AnualSuply" class="form-select @error('AnualSuply') is-invalid @enderror" required id="AnualSuply">
                  <option  selected value="{{$studentData->ses_anl_sup}}">{{$studentData->ses_anl_sup}}</option>
                   <option value="Anual">Anual</option>
                  <option value="Suply">Suply</option>
                </select>
                @error('AnualSuply')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label" for="role">Centre</label>
                <select name="Centre" class="form-select @error('Centre') is-invalid @enderror" required id="Centre">
                  <option  selected value="{{$studentData->ses_cnt_code}}">{{$studentData->ses_cnt_code}}</option>
                    @foreach($Centres as $Centre)
                  <option value="{{$Centre->centreCode}}">{{$Centre->centreCode}}</option>
                  @endforeach
                </select>
                @error('Centre')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>


              <div class="col-md-6">
                <label class="form-label" for="role">Group/Shift:</label>
                <select name="GroupShift" class="form-select @error('GroupShift') is-invalid @enderror" required id="GroupShift">
                  
                  <option value="{{$studentData->ses_group}}">{{$studentData->ses_group}}</option>
                   @foreach($Groups as $Group)
                  <option value="{{$Group->groupName}}">{{$Group->groupName}}</option>
                  @endforeach
                  
                </select>
                @error('GroupShift')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              

              <div class="col-md-6">
                <label class="form-label" for="role">Course Duration:</label>
                <select name="CourseDuration" class="form-select @error('CourseDuration') is-invalid @enderror" required id="CourseDuration">
                  <option selected value="{{$studentData->ses_dur}}"> {{$studentData->ses_dur}} Months</option>
                  <option value="3">3 Months</option>
                  <option value="6">6 Months</option>
                  <option value="12">1 Year</option>
                  
                </select>
                @error('CourseDuration')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>


              <div class="col-md-6">
                <label class="form-label" for="role">Exam Title</label>
                <select name="ExamTitle" class="form-select @error('ExamTitle') is-invalid @enderror" required id="ExamTitle">
                  <option selected value="{{$studentData->ses_examTitle}}">{{$studentData->ses_examTitle}}</option>
                    @foreach($ExamTitles as $ExamTitle)
                  <option value="{{$ExamTitle->titleName}}">{{$ExamTitle->titleName}}</option>
                  @endforeach
              
                  
                </select>
                @error('ExamTitle')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
               </div>
                <div class="col-md-6">
                <label class="form-label" for="role">Enter Trade Code</label>
                <select name="EnterTradeCode" class="form-select @error('EnterTradeCode') is-invalid @enderror" required id="EnterTradeCode">
                <option value="{{$studentData->ses_trade_code}}">{{$studentData->ses_trade_code}}</option>
                 @foreach($Trades as $Trade)
                  <option value="{{$Trade->tradeCode}}">{{$Trade->tradeCode}}</option>
                  @endforeach
                </select>
                @error('EnterTradeCode')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label" for="role">Select Trade</label>
                <select name="SelectTrade" class="form-select @error('SelectTrade') is-invalid @enderror" required id="SelectTrade">
                <option  selected value="{{$studentData->ses_trade_name}}">{{$studentData->ses_trade_name}}</option>
                 @foreach($Trades as $Trade)
                  <option value="{{$Trade->tradeName}}">{{$Trade->tradeName}}</option>
                  @endforeach
                </select>
                @error('SelectTrade')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label" for="username">Serial No</label>
                <input name="SerialNo" class="form-control @error('SerialNo') is-invalid @enderror" value="{{ $studentData->ses_serial_no ?? old('ses_serial_no') }}" required autocomplete="SerialNo" autofocus id="SerialNo" type="text">
                @error('SerialNo')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label" for="username">College Roll No.</label>
                <input name="CollegeRollNo" class="form-control @error('CollegeRollNo') is-invalid @enderror" value="{{ $studentData->ses_roll_no ?? old('ses_roll_no') }}" required autocomplete="CollegeRollNo" autofocus id="CollegeRollNo" type="text">
                @error('CollegeRollNo')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label" for="role">Select Gender</label>
                <select name="SelectGender" class="form-select @error('SelectGender') is-invalid @enderror" required id="SelectGender">
                <!-- <option disabled= selected >Choose...</option> -->
                <option {{ ( $studentData->ses_sex) ? 'selected' : '' }} >{{$studentData->ses_sex}}</option>

                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="TransGender">Trans Gender</option>
                </select>
                @error('SelectGender')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label" for="username">Student's CNIC No.</label>
                <input name="StudentCNICNo" class="form-control @error('StudentCNICNo') is-invalid @enderror" value="{{ $studentData->ses_cnic_no ?? old('ses_cnic_no') }}"  required autocomplete="StudentCNICNo" autofocus id="StudentCNICNo" type="text">
                @error('StudentCNICNo')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label" for="username">Student's Name</label>
                <input name="StudentName" class="form-control @error('StudentName') is-invalid @enderror" value="{{ $studentData->ses_st_name ?? old('ses_st_name') }}"   required autocomplete="StudentName" autofocus id="StudentName" type="text">
                @error('StudentName')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label" for="username">Father's Name</label>
                <input name="FatherName" class="form-control @error('FatherName') is-invalid @enderror" value="{{ $studentData->ses_f_name ?? old('ses_f_name') }}"   required autocomplete="FatherName" autofocus id="FatherName" type="text">
                @error('FatherName')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label class="form-label" for="from_date">Date of Admission</label>
                  <input name="DateofAdmission" class="form-control @error('from_date') is-invalid @enderror" value="{{ $studentData->ses_st_doa ?? old('ses_st_doa') }}" required autocomplete="DateofAdmission" autofocus  id="DateofAdmission" type="date">
                  @error('DateofAdmission')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                

                
                <div class="col-md-6">
                  <label class="form-label" for="to_date">Date of Birth</label>
                  <input name="DateofBirth" class="form-control @error('DateofBirth') is-invalid @enderror" value="{{ $studentData->ses_st_dob ?? old('ses_st_dob') }}" required autocomplete="DateofBirth" autofocus  id="DateofBirth" type="date">
                  @error('DateofBirth')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

           


              <div class="col-md-6">
                <label class="form-label" for="role">Select Qualification</label>
                <select name="SelectQualification" class="form-select @error('SelectQualification') is-invalid @enderror" required id="SelectQualification">
                 <!--  <option selected>Choose...</option> -->
                <option value="{{ $qualName }}" >{{$qualName}}</option>
                 @foreach($QualCodes as $QualCode)
                  <option selected value="{{$QualCode->qualName}}">{{$QualCode->qualName}}</option>
                  @endforeach

                 
                  
                </select>
                @error('SelectQualification')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label" for="phone"></label>
                <div class="form-check">
                  <input class="form-check-input" id="status" type="checkbox" name="status" value="active">
                  <input {{ ( $studentData->ses_status == 'active') ? 'checked' : '' }} class="form-check-input" id="status" type="checkbox" name="status" value="active">

                  <label class="form-check-label" for="status">Active/InActive</label>
                </div>
              </div>
              <div class="col-md-12">
                <label class="form-label" for="username">Student's Picture</label>
                <input type="file" name="image" class="form-control" onchange="previewFile(this);">
                <div id="show" style="width: 180px; height: 200px; valign: top; float: right; margin-right: 200px; border:1px solid black;">
                 <img id='blah' src="{{asset('avatars/').'/'.$studentData->ses_pic_name}}" alt='Picture' style="width: 180px;height: 200px;"/>
                 
               </div>
             </div>


           <!--    <div class="col-md-12">
                <label class="form-label" for="username">Student's Picture</label>
                <input type="file" name="image" class="form-control">
                <div id="show" style="width: 180px; height: 200px; valign: top; float: right; margin-right: 200px; border:1px solid black;">
                 <img id='blah' src='#' alt='Picture' />
                 
               </div>
             </div> -->
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

<script>
  function previewFile(input){
    console.log('testded');
        var file = $("input[type=file]").get(0).files[0];
        console.log(file);
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#blah").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }

</script> 
@endsection