@extends('layouts.main')
@section('title', '')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Home</span>
      </li>
      <li class="breadcrumb-item active"><span>Create Master File</span></li>
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
            <div class="card-header">Master File</div>
            <div class="card-body">
              <!-- content here -->

              <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                <form class="row g-3" method="POST" action="{{ route('addMasterFile')}}">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label" for="masterfile">Enter Year(Like 15, 16,...)</label>
                        <input class="form-control @error('masterfile') is-invalid @enderror" id="masterfile" type="text" name="masterfile">
                    </div>
                    @error('masterfile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Create Master File</button>
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