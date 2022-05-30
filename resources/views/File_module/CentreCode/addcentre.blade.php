@extends('layouts.main')
@section('title', 'Add Centre Code')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
      </li>
      @isset($centrecode)
      <li class="breadcrumb-item active"><span>Update Centre Code</span></li>
      @else
      <li class="breadcrumb-item active"><span>Add Centre Code</span></li>
      @endisset
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
             
              @isset($centrecode)
              <div class="card-header">Update Centre Code</div>
              @else
              <div class="card-header">Add Centre Code</div>
              @endisset
            
            <div class="card-body">
              <!-- content here -->
              <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                @isset($centrecode)
                <form class="row g-3" method="POST" action="{{ route('updatecentrecode')}}">
              @else
                <form class="row g-3" method="POST" action="{{ route('savecentrecode')}}">
              @endisset
               
                    @csrf
                    <input type="hidden" name="id" value="{{ $centrecode->id ?? '' }}">

                    <div class="col-md-6">
                        <label class="form-label" for="centrecode">Centre Code</label>
                        <input {{  isset($centrecode) ? 'disabled' : '' }} value="{{ $centrecode->centreCode ?? old('centrecode') }}" class="form-control @error('centrecode') is-invalid @enderror" id="centrecode" type="text" name="centrecode">
                        @error('centrecode')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                   

                    <div class="col-md-6">
                        <label class="form-label" for="centreName">Centre Name</label>
                        <input value="{{ $centrecode->centreName ?? old('centreName') }}" class="form-control @error('centreName') is-invalid @enderror" id="centreName" type="input" name="centreName">
                        @error('centreName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                   

                    <div class="col-md-6">
                        <label class="form-label" for="disttName">District Name</label>
                        <input value="{{ $centrecode->centreDisttName ?? old('disttName') }}" class="form-control @error('disttName') is-invalid @enderror" id="disttName" type="input" name="disttName">
                        @error('disttName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    

                    <div class="col-md-6">
                        <label class="form-label" for="centreAddress">Centre Address</label>
                        <input value="{{ $centrecode->centreAddress ?? old('centreAddress') }}" class="form-control @error('centreAddress') is-invalid @enderror" id="centreAddress" type="input" name="centreAddress">
                        @error('centreAddress')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                   

                    <div class="col-md-6">
                        <label class="form-label" for="centreZone">Centre Zone</label>
                        <input value="{{ $centrecode->centreZone ?? old('centreZone') }}" class="form-control @error('centreZone') is-invalid @enderror" id="centreZone" type="input" name="centreZone">
                        @error('centreZone')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                   

                    <div class="col-md-6">
                        <label class="form-label" for="centrePrincipal">Principal Name</label>
                        <input value="{{ $centrecode->centrePrincipal ?? old('centrePrincipal') }}" class="form-control @error('centrePrincipal') is-invalid @enderror" id="centrePrincipal" type="input" name="centrePrincipal">
                        @error('centrePrincipal')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    

                    <div class="col-md-6">
                        <label class="form-label" for="centreContactNo">Contact No</label>
                        <input value="{{ $centrecode->centreContactNo ?? old('centreContactNo') }}" class="form-control @error('centreContactNo') is-invalid @enderror" id="centreContactNo" type="input" name="centreContactNo">
                        @error('centreContactNo')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                   
                    <div class="col-md-6">
                        <label class="form-label" for="CentreEmail">Email Address</label>
                        <input value="{{ $centrecode->centreEmail ?? old('CentreEmail') }}" class="form-control @error('CentreEmail') is-invalid @enderror" id="CentreEmail" type="email" name="CentreEmail">
                        @error('CentreEmail')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                   
                    <div class="col-md-6">
                        <div class="form-check">
                        <input  {{ ( isset($centrecode) && $centrecode->centreStatus == 'A') ? 'checked' : '' }} class="form-check-input" id="status" type="checkbox" name="status" value="A">
                        <label class="form-check-label" for="status">Active/InActive</label>
                        </div>
                    </div>

             
                       <div class="col-12">
                       @isset($centrecode)
                       <button class="btn btn-primary" type="submit">Update Centre Codes</button>
                       @else
                       <button class="btn btn-primary" type="submit">Add Centre Codes</button>
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