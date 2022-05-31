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



<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <!-- <div class="row"> -->
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="card mb-4">
            <div class="card-header">Control Panel</div>
            <div class="card-body">
              <!-- content here -->

              <div class="table-responsive">
                    <table id="example" class="table border mb-0">
                      <thead class="table-light fw-semibold">
                        <tr class="align-middle">
                         
                          <th>Institue</th>
                          <th>Records Submitted</th>
                          <th>Records in Progress</th>
                        </tr>
                      </thead>
                      <tbody>

                      @foreach($records as $record)
                        <tr class="align-middle">
                       
                          <td>
                            <div>{{ $record->name}}</div>
                            <!-- <div class="small text-medium-emphasis">{{ $record->name}}</div> -->
                          </td>
                        <!-- Students Submitted -->
                          <td>
                            <div class="clearfix">
                              <div class="float-start">
                                <div class="fw-semibold">{{ $record->submitted}}</div>
                              </div>
                            </div>
                            <div class="progress progress-thin">
                              <div class="progress-bar bg-success" role="progressbar" style="width: {{ $record->submitted}}%" aria-valuenow="{{ $record->submitted}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>

                          <!-- student Added -->
                          <td>
                            <div class="clearfix">
                              <div class="float-start">
                                <div class="fw-semibold">{{ $record->recorded}}</div>
                              </div>
                            </div>
                            <div class="progress progress-thin">
                              <div class="progress-bar bg-success" role="progressbar" style="width: {{ $record->recorded}}%" aria-valuenow="{{ $record->recorded}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                         
                         
                      
                        </tr>
                        @endforeach
                       
                      </tbody>
                    </table>
                  </div>
     
    <!-- </div> -->
  </div>
</div> 
@endsection



@section('javascript')

  <!-- $(document).ready(function() {
      $('#example').DataTable({});
  } ); -->

@endsection
