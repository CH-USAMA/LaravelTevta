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
          @isset($examtitle)
          <div class="card-header">Update Exam Title</div>
            @else
            <div class="card-header">Add Exam Title</div>
            @endisset
            <div class="card-body">
              <!-- content here -->
              <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                    @isset($examtitle)
                    <form class="row g-3" method="POST" action="{{ route('updateexamtitle')}}">
                    @else
                    <form class="row g-3" method="POST" action="{{ route('saveexamtitle')}}">
                    @endisset
               
                    @csrf
                    <input type="hidden" name="id" value="{{ $examtitle->id ?? '' }}">

                    <div class="col-md-6">
                        <label class="form-label" for="titleName">Exam Title</label>
                        <input  {{  isset($examtitle) ? 'disabled' : '' }} value="{{ $examtitle->titleName ?? '' }}" class="form-control @error('titleName') is-invalid @enderror" id="titleName" type="text" name="titleName">
                        @error('titleName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    

                    <div class="col-md-6">
                        <label class="form-label" for="exThMks">Theory Total Marks</label>
                        <input  value="{{ $examtitle->exThMks ?? '' }}" class="form-control @error('exThMks') is-invalid @enderror" id="exThMks" type="input" name="exThMks">
                        @error('exThMks')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                   

                    <div class="col-md-6">
                        <label class="form-label" for="exPrMks">Practical Total Marks</label>
                        <input value="{{ $examtitle->exPrMks ?? '' }}" class="form-control @error('exPrMks') is-invalid @enderror" id="exPrMks" type="input" name="exPrMks">
                        @error('exPrMks')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    

                    <div class="col-md-6">
                        <label class="form-label" for="exThPass">Theory Passing Marks</label>
                        <input value="{{ $examtitle->exThPass ?? '' }}" class="form-control @error('exThPass') is-invalid @enderror" id="exThPass" type="input" name="exThPass">
                        @error('exThPass')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                   

                    <div class="col-md-6">
                        <label class="form-label" for="exPrPass">Practical Passing Marks</label>
                        <input  value="{{ $examtitle->exPrPass ?? '' }}" class="form-control @error('exPrPass') is-invalid @enderror" id="exPrPass" type="input" name="exPrPass">
                        @error('exPrPass')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                    </div>
                   

                    <div class="col-md-6">
                        <label class="form-label" for="exDur">Duration</label>
                        <input value="{{ $examtitle->exDur ?? '' }}" class="form-control @error('exDur') is-invalid @enderror" id="exDur" type="input" name="exDur"> 
                        @error('exDur')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                   
    
             
                       <div class="col-12">
                       @isset($examtitle)
                       <button class="btn btn-primary" type="submit">Update Exam title</button>
                        @else
                        <button class="btn btn-primary" type="submit">Add Exam title</button>
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