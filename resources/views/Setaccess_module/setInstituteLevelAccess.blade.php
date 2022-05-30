@extends('layouts.main')
@section('title', 'Institute List')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Home</span>
      </li>
      <li class="breadcrumb-item active"><span>Institute Level Access</span></li>
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
            <div class="card-header">List of Institutes <a href="{{ route('register') }}" class="btn btn-secondary" style="float:right;">Add User</a><button type="submit" class="btn btn-secondary" style="float:right;  margin-right: 10px;">Delete Selected User</button><br><br></div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                  <th></th>
                    <th>Nr</th>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                   
                    <th>User Type</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Session</th>
                    <th>Action</th>
                    <th>Set Access</th>


                  </tr>
                </thead>
                <tbody>

                  @foreach($user as $user)
                  
                  <tr>
                    <td><input type="checkbox" name="delete[]"  value="{{ $user->id}}" /></td>
                    <td>{{ $no++ }}</td>
                    <td>{{$user->username}}</td>
                    <td>{{ $user->firstname}}</td>
                    <td>{{ $user->lastname}}</td>
            
                    <td>{{ $user->role}}</td>
                    <td>{{date('Y-m-d', strtotime($user->from_date)) }}</td>
                    <td>{{date('Y-m-d', strtotime($user->to_date)) }}</td>
                    <td>{{ $user->session ?? 'N/A'}}</td>
                    <td><a href="{{ route('InstitueLevelAccessEdit',['id' => Crypt::encrypt($user->id)])}}">Set Access</a></td>

                    <!-- <td><input type="checkbox" class="changeStatus" name="checkbox" value="{{$user->id}}" /></td> -->
                    <td> <input data-id="{{$user->id}}" class="changeStatus" type="checkbox" data-onstyle="success" data-offstyle="danger"
                     data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status=='active' ? 'checked' : '' }}></td>
                    

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
        "scrollX": true
      });
  } );






$(function() {
    $('.changeStatus').change(function() {
        var status = $(this).prop('checked') == true ? 'active' : 'inactive'; 
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

