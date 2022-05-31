@extends('layouts.main')

@section('content')
<div class="header-divider"></div>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Home</span>
              </li>
              <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
          </nav>
        </div>
      </header>
      @if(Auth::user()->role == 'Administrator')
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="row">

            <div class="col-sm-6 col-lg-6">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">System Users</div>
                    
                    <div><strong>Institutes:</strong> {{\App\Models\User::where(['role' => 'Institute'])->count();}} </div>
                    <div><strong>Board:</strong> {{\App\Models\User::where(['role' => 'Board'])->count();}}</div>
                    <div><strong>Administrator:</strong> {{\App\Models\User::where(['role' => 'Administrator'])->count();}}</div>

                  </div>
                  
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->

            <!-- Trades / Groups / Exam Titles -->

            <div class="col-sm-6 col-lg-6">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">System Stats</div>
                    
                    <div> <strong>Trade Codes:</strong> {{\App\Models\Trades::where(['tradeStatus' => 'A'])->count();}} </div>
                    <div> <strong>Centre Codes:</strong> {{\App\Models\Centres::where(['centreStatus' => 'A'])->count();}}</div>
                    <div> <strong>Total Sessions:</strong> {{\App\Models\SessionHistory::where(['s_status' => 1])->count();}}</div>

                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
              </div>
            </div>
            <!--  -->
          
            <!-- /.col-->
            <div class="col-sm-6 col-lg-12">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold"> {{\App\Models\AgeLimit::where(['id' => 1])->first()->agelimit;}}</div>
                    <div>AGE LIMIT</div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3" style="height:70px;">
                  <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            
            <!-- /.col-->
          </div>
          <!-- /.row-->
        @endif
          <!-- /.row-->
        </div>
      </div>
 
@endsection
