@extends('layouts.main')
@section('title', 'Strength Session Wise')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Set Access</span>
      </li>
      <li class="breadcrumb-item active"><span>Enter Strength Session Wise</span></li>
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
            <div class="card-header">Enter Strength Session Wise</div>
            <div class="card-body">
              <!-- content here -->
    <form class="row g-3" method="POST" action="{{route('strengthSessionWiseUpdate')}}">
       @csrf
       
    <div class="row">
    <div class="col-md-6">
        <label class="form-label" for="session">Enter Session</label>
        <input name="session" class="form-control @error('session') is-invalid @enderror" value="{{ $user->session ?? old('session') }}" required autocomplete="session" autofocus  id="session" type="input">
        @error('session')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

    <div class="col-md-6">
        <label class="form-label" for="session_strength">Select Limit (A for All or 1-59)</label>
        <input name="session_strength" class="form-control @error('session_strength') is-invalid @enderror" value="{{ $user->session_strength ?? old('session_strength') }}" required autocomplete="session_strength"   id="session_strength" type="input">
        @error('session_strength')
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

     
    <!-- </div> -->
  </div>
</div> 
@endsection



