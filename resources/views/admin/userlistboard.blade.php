@extends('layouts.main')
@section('title', 'Grant Permission to User')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Home</span>
      </li>
      <li class="breadcrumb-item active"><span>Grant Permission to User</span></li>
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
            <div class="card-header">List of Users <a href="{{ route('register') }}" class="btn btn-secondary" style="float:right;">Add User</a><button type="submit" class="btn btn-secondary" style="float:right;  margin-right: 10px;">Delete Selected User</button><br><br></div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                  <th></th>
                    <th>Nr</th>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-mail</th>
                    <th>Telephone</th>
                    <th>User Type</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>

                  @foreach($user as $user)
                  
                  <tr>
                    <td><input type="checkbox" name="delete[]"  value="{{ $user->id}}" /></td>
                    <td>{{ $no++ }}</td>
                    <td><a href="{{ route('editUser',['id' => Crypt::encrypt($user->id)])}}">{{ $user->username}}</a></td>
                    <td>{{ $user->firstname}}</td>
                    <td>{{ $user->lastname}}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->phonenumber}}</td>
                    <td>{{ $user->role}}</td>
                    <!-- <td><input type="checkbox" class="changeStatus" name="checkbox" value="{{$user->id}}" /></td> -->
                    <td> <input data-id="{{$user->id}}" class="changeStatus" type="checkbox" data-onstyle="success" data-offstyle="danger"
                     data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status == 'active' ? 'checked' : '' }}></td>
                    

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






  $("#example").on("click", ".changeStatus", function(){
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
@endsection

