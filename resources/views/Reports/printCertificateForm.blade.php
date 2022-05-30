@extends('layouts.main')

@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>SCE</span>
      </li>
      <li class="breadcrumb-item active"><span>Print Certificate</span></li>
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


@endphp

<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <!-- <div class="row"> -->
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="card mb-4">
            <div class="card-header">Enter Session</div>
            <div class="card-body">
              <form class="row g-3" method="POST" action="{{url('print-certificate-report')}}">
               @csrf

                  <div class="col-md-6">
                <label class="form-label" for="role">Enter Session</label>
                <select name="session" class="form-select @error('session') is-invalid @enderror" required id="session">
                  <option disabled selected>Choose...</option>
                  @foreach($SessionHistories as $SessionHistory)
                  <option value="{{$SessionHistory->s_name}}">{{$SessionHistory->s_name}}</option>
                  @endforeach
                  
                </select>
                @error('session')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label" for="role">Centre Code</label>
                <select name="CentreCode" class="form-select @error('CentreCode') is-invalid @enderror" required id="CentreCode">
                  <option disabled selected>Choose...</option>
                  @foreach($Centres as $Centre)
                  <option value="{{$Centre->centreCode}}">{{$Centre->centreCode}}</option>
                  @endforeach
                </select>
                @error('CentreCode')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label" for="role">Select Centre</label>
                <select name="SelectCentre" class="form-select @error('SelectCentre') is-invalid @enderror" required id="SelectCentre">
                  <option  disabled selected>Choose...</option>
                  @foreach($Centres as $Centre)
                  <option value="{{$Centre->centreName}}">{{$Centre->centreName}}</option>
                  @endforeach
                </select>
                @error('SelectCentre')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label class="form-label" for="role">Enter Exam Title</label>
                <select name="ExamTitles" class="form-select @error('ExamTitles') is-invalid @enderror" required id="ExamTitles">
                  <option disabled selected>Choose...</option>
                  @foreach($ExamTitles as $ExamTitle)
                  <option value="{{$ExamTitle->titleName}}">{{$ExamTitle->titleName}}</option>
                  @endforeach
                </select>
                @error('ExamTitles')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label" for="role">Select Group</label>
                <select name="SelectGroup" class="form-select @error('SelectGroup') is-invalid @enderror" required id="SelectGroup">
                  <option  disabled selected>Choose...</option>
                  @foreach($Groups as $Group)
                  <option value="{{$Group->groupName}}">{{$Group->groupName}}</option>
                  @endforeach
                  
                </select>
                @error('SelectGroup')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

             <div class="col-md-6">
                  <label class="form-label" for="from_date">Certificate Date</label>
                  <input name="CertificateDate" class="form-control @error('from_date') is-invalid @enderror" value="" required autocomplete="CertificateDate" autofocus  id="CertificateDate" type="date">
                  @error('CertificateDate')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

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
  @endsection