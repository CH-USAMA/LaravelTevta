@extends('layouts.main')
@section('title', 'Age LIMIT')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Set Access</span>
      </li>
      <li class="breadcrumb-item active"><span>Age LIMIT</span></li>
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
            <div class="card-header"> Age LIMIT</div>
            <div class="card-body">
              <!-- content here -->
                <form class="row g-3" method="POST" action="{{ route('saveagelimit') }}">
                @csrf
                
                <div class="row">
                {{-- <div class="col-md-6">
                    <label class="form-label" for="agelimit">Enter Session</label>
                    <input name="session" class="form-control @error('session') is-invalid @enderror" value="{{ $user->session ?? old('session') }}" required autocomplete="session" autofocus  id="session" type="input">
                </div>
                </div> --}}
                <input type="hidden" name="id" value="{{ $agelimit->id ?? '' }}">

                <div class="col-md-6">
                    <label class="form-label" for="agelimit">Enter Age Limit</label>
                    <input name="agelimit" class="form-control @error('agelimit') is-invalid @enderror" value="{{ $agelimit->agelimit ?? old('agelimit') }}" required autocomplete="agelimit"   id="agelimit" type="input">
                    @error('agelimit')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                </div>
                
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">SET AGE</button>
                    </div>
                        </div>
                    </div>
                </div>

     
    <!-- </div> -->
  </div>
</div> 
@endsection



