@extends('layouts.main')
@section('title', 'Punjab Access')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Set Access</span>
      </li>
      <li class="breadcrumb-item active"><span>Punjab Level</span></li>
    </ol>
  </nav>
</div>
</header>


<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <!-- <div class="row"> -->
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="card mb-4">
            <div class="card-header">Set Access Punjab Level</div>
            <div class="card-body">
              <!-- content here -->
<form class="row g-3" method="POST" action="{{ route('InstitueLevelAccessUpdate')}}">
       @csrf
       <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" id="punjab_level_access" name="total_access" type="checkbox">
          <label class="form-check-label" for="punjab_level_access">Punjab Level Access On/Off</label>
        </div>
      </div>
      <input type="hidden" name="id" value="{{$user->id ?? ''}}">
      <div><span><u><strong>Permission Punjab Level On/Off</strong></u></span></div>
      <div class="col-12">
        <div class="form-check">
          <label class="form-check-label"  for="enter_data">Enter Data</label>
          <input {{ ( $user->can('Enter Data'))  ? 'checked' : '' }} class="form-check-input" name="data_access" id="enter_data" type="checkbox">
        </div>
      </div>

      <div class="col-12">
        <div class="form-check">
          <label class="form-check-label" for="edit_list">Edit List</label>
          <input {{ ( $user->can('Edit List'))  ? 'checked' : '' }} class="form-check-input" name="edit_list_access" id="edit_list" type="checkbox">
        </div>
        </div>
        <div class="col-12">
        <div class="form-check">
            <label class="form-check-label" for="admission_list">Admittance Slip</label>
            <input {{ ( $user->can('Admittance Slip'))  ? 'checked' : '' }} class="form-check-input" name="admit_access" id="admission_list" type="checkbox">
        </div>
        </div>
        <div class="col-12">
         <div class="form-check">
            <label class="form-check-label" for="enter_attendence">Enter Attendance</label>
            <input {{ ( $user->can('Enter Attendance'))  ? 'checked' : '' }} class="form-check-input" id="enter_attendence" type="checkbox" name = "attendance_access">
            </div>
        </div>
    <div class="row">
    <div class="col-md-6">
        <label class="form-label" for="from_date">From Date</label>
        <input name="from_date" class="form-control @error('from_date') is-invalid @enderror" value="{{  date('Y-m-d', strtotime($user->from_date))  ?? old('from_date') }}" required autocomplete="from_date" autofocus  id="from_date" type="date">
        @error('from_date')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
      
    <div class="row">
    <div class="col-md-6">
        <label class="form-label" for="to_date">To Date</label>
        <input name="to_date" class="form-control @error('to_date') is-invalid @enderror" value="{{ date('Y-m-d', strtotime($user->to_date)) ?? old('to_date') }}" required autocomplete="to_date" autofocus  id="to_date" type="date">
        @error('to_date')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

     
       
        <div class="col-12">
            <button class="btn btn-primary" type="submit">OK</button>
        </div>
            </div>
        </div>
    </div>
</form>
     
    <!-- </div> -->
  </div>
</div> 
@endsection



