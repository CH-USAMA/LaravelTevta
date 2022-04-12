@extends('layouts.main')
@section('title', 'Control Panel')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Home</span>
      </li>
      <li class="breadcrumb-item active"><span>Control Panel</span></li>
    </ol>
  </nav>
</div>
</header>
<style>
    .list-group{
    max-height: 300px;
    margin-bottom: 10px;
    overflow:scroll;
    -webkit-overflow-scrolling: touch;
}
</style>


<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <!-- <div class="row"> -->
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="card mb-4">
            <div class="card-header">Control Panel</div>
            <div class="card-body">
              <!-- content here -->

              <div class="row">
                  <div class="col-md-6">
                  <div class="panel panel-primary" id="result_panel">
    <div class="panel-heading"><h3 class="panel-title">Record in Progress</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
        </ul>
    </div>
</div>
                  </div>
                  <div class="col-md-6">
                  <div class="panel panel-primary" id="result_panel">
    <div class="panel-heading"><h3 class="panel-title">Record Submitted</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
            <li class="list-group-item">Session Number
            </li>
        </ul>
    </div>
</div>
                  </div>

              </div>
            </div>
        </div>
    </div>

     
    <!-- </div> -->
  </div>
</div> 
@endsection