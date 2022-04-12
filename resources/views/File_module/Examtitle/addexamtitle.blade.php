@extends('layouts.main')
@section('title', 'Add Exam Title')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
      </li>
      <li class="breadcrumb-item active"><span>Add Exam Title</span></li>
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
            <div class="card-header">Add Exam Title</div>
            <div class="card-body">
              <!-- content here -->
              <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                <form class="row g-3" method="POST" action="{{ route('addexamtitle')}}">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label" for="examtitle">Exam Title</label>
                        <input class="form-control @error('examtitle') is-invalid @enderror" id="examtitle" type="text" name="examtitle">
                    </div>
                    @error('examtitle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="col-md-6">
                        <label class="form-label" for="exThMks">Theory Total Marks</label>
                        <input class="form-control @error('exThMks') is-invalid @enderror" id="exThMks" type="input" name="exThMks">
                    </div>
                    @error('exThMks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="col-md-6">
                        <label class="form-label" for="exPrMks">Practical Total Marks</label>
                        <input class="form-control @error('exPrMks') is-invalid @enderror" id="exPrMks" type="input" name="exPrMks">
                    </div>
                    @error('exPrMks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="col-md-6">
                        <label class="form-label" for="exThPass">Theory Passing Marks</label>
                        <input class="form-control @error('exThPass') is-invalid @enderror" id="exThPass" type="input" name="exThPass">
                    </div>
                    @error('exThPass')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="col-md-6">
                        <label class="form-label" for="exPrPass">Practical Passing Marks</label>
                        <input class="form-control @error('exPrPass') is-invalid @enderror" id="exPrPass" type="input" name="exPrPass">
                    </div>
                    @error('exPrPass')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="col-md-6">
                        <label class="form-label" for="duration">Duration</label>
                        <input class="form-control @error('duration') is-invalid @enderror" id="duration" type="input" name="duration">
                    </div>
                    @error('duration')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
    
             
                       <div class="col-12">
                        <button class="btn btn-primary" type="submit">Add Exam title</button>
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