@extends('layouts.main')
@section('title', 'Set Auto Attendance')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Home</span>
      </li>
      <li class="breadcrumb-item active"><span>Set Auto Attendance</span></li>
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
            <div class="card-header">Enter Session</div>
            <div class="card-body">
              <!-- content here -->
              <form class="row g-3" method="POST" action="{{ route('allpunjabAccesssave')}}">
       @csrf
       <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" id="punjab_level_access" name="total_access" type="checkbox">
          <label class="form-check-label" for="punjab_level_access">Punjab Level Access On/Off</label>
        </div>
      </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">OK</button>
        </div>
              <!-- content end -->
            </div>
        </div>
    </div>

     
    <!-- </div> -->
  </div>
</div> 
@endsection