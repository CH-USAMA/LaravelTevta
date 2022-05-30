@extends('layouts.main')

@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>SCE</span>
      </li>
      <li class="breadcrumb-item active"><span>Attendence Sheet</span></li>
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
              <form class="row g-3" method="POST" action="{{url('attendence_sheet_report')}}">
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
                <label class="form-label" for="role">Enter Trade Code</label>
                <select name="SelectTrade" class="form-select @error('SelectTrade') is-invalid @enderror" required id="SelectTrade">
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
                <label class="form-label" for="role">Select Type</label>
                <select name="SelectType" class="form-select @error('SelectType') is-invalid @enderror" required id="SelectType">
                  <option disabled= selected >Choose...</option>
                  <option value="Theory">Theory</option>
                  <option value="Practical">Practical</option>
                  
                </select>
                @error('SelectType')
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