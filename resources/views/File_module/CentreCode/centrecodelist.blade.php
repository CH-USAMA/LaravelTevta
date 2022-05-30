@extends('layouts.main')
@section('title', 'Centre Code')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
      </li>
      <li class="breadcrumb-item active"><span>Centre Codes</span></li>
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
            <input type="hidden" name="table" value="centres">
            <div class="card-header">List of Centres <a href="{{ route('addcentrecode') }}" class="btn btn-secondary" style="float:right;">Add Centre Code</a><button type="submit" class="btn btn-secondary" style="float:right;  margin-right: 10px;">Remove Selected Centre</button><br><br></div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                  <th></th>
                    <th>Nr</th>
                    <th>Centre Code</th>
                    <th>Centre Name</th>
                    <th>District Name</th>
                    <th>Centre Address</th>
                    <th>Zone</th>
                    <th>Principal Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Open</th>



                  </tr>
                </thead>
                <tbody>

                  @foreach($centrecodes as $centrecode)
                  
                  <tr>
                    <td><input type="checkbox" name="delete[]"  value="{{ $centrecode->id}}" /></td>
                    <td>{{ $no++ }}</td>
                    <td><a href="{{ route('editcentrecode',['id' => Crypt::encrypt($centrecode->id)])}}">{{ $centrecode->centreCode}}</a></td>
                    <td>{{ $centrecode->centreName}}</td>
                    <td>{{ $centrecode->centreDisttName}}</td>
                    <td>{{ $centrecode->centreAddress}}</td>
                    <td>{{ $centrecode->centreZone}}</td>
                    <td>{{ $centrecode->centrePrincipal}}</td>
                    <td>{{ $centrecode->centreContactNo}}</td>
                    <td>{{ $centrecode->centreEmail}}</td>
                    <td> <input data-id="{{$centrecode->id}}" class="changeStatus" type="checkbox" data-onstyle="success" data-offstyle="danger"
                     data-toggle="toggle" data-on="Active" data-off="InActive" {{ $centrecode->centreStatus == "A" ? 'checked' : '' }}></td>
                    <td>{{ $centrecode->centreOC}}</td>
                   

                
                    

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
    var status = $(this).prop('checked') == true ? 'A' : 'D'; 
        var centre_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatusCentre',
            data: {'status': status, 'centre_id': centre_id},
            success: function(data){
              console.log(data.success)
              toastr.info("Status changed Successfully");
            }
        });
  });


@endsection

