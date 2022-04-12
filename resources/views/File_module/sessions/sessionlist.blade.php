@extends('layouts.main')
@section('title', 'Session')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
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
            <input type="hidden" name="table" value="users">
            <div class="card-header">List of Sessions <a href="{{ route('newSession') }}" class="btn btn-secondary" style="float:right;">Add Session</a><button type="submit" class="btn btn-secondary" style="float:right;  margin-right: 10px;">Delete Selected User</button></div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                  <th></th>
                    <th>Nr</th>
                    <th>Session Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>


                  </tr>
                </thead>
                <tbody>

                  @foreach($sessions as $session)
                  
                  <tr>
                    <td><input type="checkbox" name="delete[]"  value="{{ $session->id}}" /></td>
                    <td>{{ $no++ }}</td>
                    <td><a href="{{ route('editSession',['id' => Crypt::encrypt($session->id)])}}">{{ $session->s_name}}</a></td>
                    <td>{{ $session->s_start_date}}</td>
                    <td>{{ $session->s_end_date}}</td>

                   

                    <td> <input data-id="{{$session->id}}" class="changeStatus" type="checkbox" data-onstyle="success" data-offstyle="danger"
                     data-toggle="toggle" data-on="Active" data-off="InActive" {{ $session->s_status ? 'checked' : '' }}></td>

                
                    

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
        var status = $(this).prop('checked') == true ? active : inactive; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatusUser',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
              toastr.info("Status changed Successfully");
            }
        });
    })
  })
@endsection

