@extends('layouts.main')
@section('title', 'Session')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Set Access</span>
      </li>
      <li class="breadcrumb-item active"><span>Sessions</span></li>
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
          <form action="{{ route('deleteSelected')}}" method="POST" >
            @csrf
            <input type="hidden" name="table" value="seshis">
            <div class="card-header">List of Sessions </div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                    <th>Nr</th>
                    <th>Session Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Set Access</th>
                    <th>Access</th>


                  </tr>
                </thead>
                <tbody>

                  @foreach($sessions as $session)
                  
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $session->s_name}}</td>
                    <td>{{ $session->s_start_date}}</td>
                    <td>{{ $session->s_end_date}}</td>
                    <td><a href="#">SET ACCESS</a></td>


                   

                    <td> <input data-id="{{$session->id}}" class="changeStatus" type="checkbox" data-onstyle="success" data-offstyle="danger"
                     data-toggle="toggle" data-on="Active" data-off="InActive" {{ $session->s_status == 1 ? 'checked' : '' }}></td>

                
                    

                  </tr>
                  </form>
                  @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

     
    <!-- </div> -->
  </div>
</div> 

@endsection

@section('javascript')

  $(document).ready(function() {
      $('#example').DataTable({
      });
  } );


  $(function() {
    $('.changeStatus').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var session_id = $(this).data('id'); 
          
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatusSession',
            data: {'status': status, 'session_id': session_id},
            success: function(data){
              console.log(data.success)
              toastr.info("Status changed Successfully");
            }
        });
    })
  })
@endsection

