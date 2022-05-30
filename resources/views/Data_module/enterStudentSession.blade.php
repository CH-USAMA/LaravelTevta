@extends('layouts.main')

@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Enter</span>
      </li>
      <li class="breadcrumb-item active"><span>Session</span></li>
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
              <form class="row g-3" method="POST" action="{{url('sessionToAddStudent')}}">
               @csrf

               <div class="col-md-6">
                <label class="form-label" for="role">Enter Session</label>
                <select name="EnterSession" class="form-select @error('EnterSession') is-invalid @enderror" required id="EnterSession">
                
                <option value="{{$data['Session']}}">{{$data['Session']}}</option> 
                </select>
                @error('EnterSession')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

                  <div class="col-md-6">
                <label class="form-label" for="role">Exam Title</label>
                <select name="ExamTitle" class="form-select @error('ExamTitle') is-invalid @enderror" required id="ExamTitle">
                  <option disabled selected>Choose...</option>
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
                <label class="form-label" for="role">Enter Trade Code</label>
                <select name="EnterTradeCode" class="form-select @error('EnterTradeCode') is-invalid @enderror" required id="EnterTradeCode">
                  <option disabled selected>Choose...</option>
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
                  <option disabled selected>Choose...</option>
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
                <label class="form-label" for="role">Course Duration</label>
                <select name="CourseDuration" class="form-select @error('CourseDuration') is-invalid @enderror" required id="CourseDuration">
                  <option disabled selected>Choose...</option>
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
                <label class="form-label" for="role">Anual/Suply</label>
                <select name="AnualSuply" class="form-select @error('AnualSuply') is-invalid @enderror" required id="AnualSuply">
                  <option disabled  selected>Choose...</option>
                  <option value="Anual">Anual</option>
                  <option value="Suply">Suply</option>
                </select>
                @error('AnualSuply')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <!-- <div class="row"> -->
                <div class="col-md-6">
                  <label class="form-label" for="EnterDate">Enter Date</label>
                  <input name="EnterDate" class="form-control @error('EnterDate') is-invalid @enderror" value="" required autocomplete="EnterDate" autofocus  id="EnterDate" type="date">
                  @error('EnterDate')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              <!-- </div> -->
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