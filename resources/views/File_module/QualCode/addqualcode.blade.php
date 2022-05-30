@extends('layouts.main')
@section('title', 'Add/Update Qualification Code')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
      </li>
      <li class="breadcrumb-item active"><span>Add Qualification Code</span></li>
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
            @isset($qual)
            <div class="card-header">Edit Qualification Code</div>
            @else
            <div class="card-header">Add Qualification Code</div>
            @endisset
            <div class="card-body">
              <!-- content here -->
              <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                @isset($qual)
                <form class="row g-3" method="POST" action="{{ route('updatequalcode')}}">
                @else
                <form class="row g-3" method="POST" action="{{ route('savequalcode')}}">
                @endisset
               
                    @csrf
                    <input type="hidden" name="id" value="{{ $qual->id ?? '' }}">
                    <div class="col-md-6">
                        <label {{  isset($qual) ? 'disabled' : '' }} class="form-label" for="qualCode">Qualification Code</label>
                        <input class="form-control @error('qualCode') is-invalid @enderror" id="qualCode" type="text" name="qualCode" value="{{ $qual->qualCode ?? '' }}">
                        @error('qualCode')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="qualName">Qualification Name</label>
                        <input class="form-control @error('qualName') is-invalid @enderror" id="qualName" type="text" name="qualName" value="{{ $qual->qualName ?? '' }}">
                        @error('qualName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-check">
                        <input  {{ ( isset($qual) && $qual->qualStatus == 'A') ? 'checked' : '' }} class="form-check-input" id="status" type="checkbox" name="status" value="A">
                        <label class="form-check-label" for="status">Active/InActive</label>
                        </div>
                    </div>
                   
                  

                      
                       <div class="col-12">
                       @isset($qual)
                       <button class="btn btn-primary" type="submit">Update Qualification Code</button>
                      @else
                      <button class="btn btn-primary" type="submit">Add Qualification Code</button>
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