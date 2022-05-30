@extends('layouts.main')
@section('title', 'Close Session')
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
            <div class="card-header">Enter Session to close(Like 1015A, 1115B,......)</div>
            <div class="card-body">
              <!-- content here -->
              <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                <form class="row g-3" method="POST" action="{{ route('closingsession')}}">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label" for="close_Session">Enter Session to close</label>
                        <input class="form-control @error('close_Session') is-invalid @enderror" id="close_Session" type="text" name="close_Session">
                        @error('close_Session')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    

                   
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Close Session</button>
                        <!-- <button class="btn btn-primary" type="submit">Back</button> -->

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