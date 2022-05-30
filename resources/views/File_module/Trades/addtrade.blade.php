@extends('layouts.main')
@section('title', 'Add/Update Trade')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
      </li>
      <li class="breadcrumb-item active"><span>Add Trade</span></li>
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
            @isset($trade)
            <div class="card-header">Edit Trade</div>
            @else
            <div class="card-header">Add Trade</div>
            @endisset
            <div class="card-body">
              <!-- content here -->
              <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                @isset($trade)
                <form class="row g-3" method="POST" action="{{ route('updatetrade')}}">
                @else
                <form class="row g-3" method="POST" action="{{ route('savetrade')}}">
                @endisset
               
                    @csrf
                    <input type="hidden" name="id" value="{{ $trade->id ?? '' }}">
                    <div class="col-md-6">
                        <label class="form-label" for="tradeCode">Trade Code</label>
                        <input {{  isset($trade) ? 'disabled' : '' }} class="form-control @error('tradeCode') is-invalid @enderror" id="tradeCode" type="text" name="tradeCode" value="{{ $trade->tradeCode ?? '' }}">
                        @error('tradeCode')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="tradeName">Trade Name</label>
                        <input class="form-control @error('tradeName') is-invalid @enderror" id="tradeName" type="text" name="tradeName" value="{{ $trade->tradeName ?? '' }}">
                        @error('tradeName')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="tradeThMks">Theory Marks</label>
                        <input class="form-control @error('tradeThMks') is-invalid @enderror" id="tradeThMks" type="text" name="tradeThMks" value="{{ $trade->tradeThMks ?? '' }}">
                        @error('tradeThMks')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="tradePrMks">Practical Marks</label>
                        <input class="form-control @error('tradePrMks') is-invalid @enderror" id="tradePrMks" type="text" name="tradePrMks" value="{{ $trade->tradePrMks ?? '' }}">
                        @error('tradePrMks')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="tradeThPass">Passing Practical Marks</label>
                        <input class="form-control @error('tradeThPass') is-invalid @enderror" id="tradeThPass" type="text" name="tradeThPass" value="{{ $trade->tradeThPass ?? '' }}">
                        @error('tradeThPass')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="tradePrPass">Passing Theory Marks</label>
                        <input class="form-control @error('tradePrPass') is-invalid @enderror" id="tradePrPass" type="text" name="tradePrPass" value="{{ $trade->tradePrPass ?? '' }}">
                        @error('tradePrPass')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="tradeDur">Duration</label>
                        <input class="form-control @error('tradeDur') is-invalid @enderror" id="tradeDur" type="text" name="tradeDur" value="{{ $trade->tradeDur ?? '' }}">
                        @error('tradeDur')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-check">
                        <input  {{ ( isset($trade) && $trade->tradeStatus == 'A') ? 'checked' : '' }} class="form-check-input" id="status" type="checkbox" name="status" value="A">
                        <label class="form-check-label" for="status">Active/InActive</label>
                        </div>
                    </div>
                   
                  

                      
                       <div class="col-12">
                       @isset($trade)
                       <button class="btn btn-primary" type="submit">Update Trade</button>
                      @else
                      <button class="btn btn-primary" type="submit">Add Trade</button>
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