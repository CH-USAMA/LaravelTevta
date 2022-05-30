@extends('layouts.main')
@section('title', 'Create New Session')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
      </li>
      <li class="breadcrumb-item active"><span>Create New Session</span></li>
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
                    @isset($session)
                    <div class="card-header">Update Session</div>
                    @else
                    <div class="card-header">Enter New Session (Like 1015A, 1115B,......)</div>
                    @endisset
            <div class="card-body">
              <!-- content here -->
              <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                @isset($session)
                <form class="row g-3" method="POST" action="{{ route('updatesession')}}">
                    @else
                    <form class="row g-3" method="POST" action="{{ route('addSession')}}">
                    @endisset
                
                    @csrf
                    <input type="hidden" name="id" value="{{ $session->id ?? '' }}">

                    <div class="col-md-6">
                        <label class="form-label" for="session_code">Enter New Session</label>
                        <input {{  isset($session) ? 'disabled' : '' }} class="form-control @error('session_code') is-invalid @enderror" id="session_code" type="text" name="session_code" value="{{ $session->s_name ?? old('session_code') }}">
                        @error('session_code')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                    </div>
                    

                    <!-- <div class="col-md-6">
                        <label class="form-label" for="age_limit">Age Limit</label>
                        <input class="form-control @error('age_limit') is-invalid @enderror" id="age_limit" type="input" name="age_limit">
                    </div>
                    @error('age_limit')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror -->

                    <div class="col-md-6">
                        <label class="form-label" for="start_date">Start Date</label>
                        <input class="form-control @error('start_date') is-invalid @enderror" id="start_date" type="date" name="start_date" value="{{ isset($session) ? date('Y-m-d', strtotime($session->s_start_date))  ?? old('start_date') : ''}}">
                        @error('start_date')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                   

                    <div class="col-md-6">
                        <label class="form-label" for="end_date">End Date</label>
                        <input class="form-control @error('end_date') is-invalid @enderror" id="end_date" type="date" name="end_date"  value="{{  isset($session) ? date('Y-m-d', strtotime($session->s_end_date))  ?? old('end_date') : ''}}">
                        @error('end_date')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    

                   

                    <!-- <div class="col-md-6">
                        <label class="form-label" for="exam_title">Exam Title</label>
                        <input class="form-control @error('exam_title') is-invalid @enderror" id="exam_title" type="input" name="exam_title">
                    </div>
                    @error('exam_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror -->

                    <div class="col-12">
                    @isset($session)
                    <button class="btn btn-primary" type="submit">Update Session</button>
                    @else
                    <button class="btn btn-primary" type="submit">Add Session</button>
                    @endisset
                       
                    </div>
                    </form>
                </div>
            </div> 
              <!-- ----- -->
            </div>
        </div>
    </div>

     
    <!-- </div> -->
  </div>
</div> 
@endsection