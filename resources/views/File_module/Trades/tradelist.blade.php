@extends('layouts.main')
@section('title', 'Exam Title')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
      </li>
      <li class="breadcrumb-item active"><span>Trades</span></li>
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
            <input type="hidden" name="table" value="trades">
            <div class="card-header">List of Trades <a href="{{ route('addtrade') }}" class="btn btn-secondary" style="float:right;">Add Trade</a><button type="submit" class="btn btn-secondary" style="float:right;  margin-right: 10px;">Remove Selected Trade</button><br><br></div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                  <th></th>
                    <th>Nr</th>
                    <th>Trade Code</th>
                    <th>Trade Name</th>
                    <th>Theory Marks</th>
                    <th>Practical Marks</th>
                    <th>Theory Passing Marks</th>
                    <th>Practical Passing Marks</th>
                    <th>Duration</th>
                    <th>Action</th>


                  </tr>
                </thead>
                <tbody>

                  @foreach($trades as $trade)
                  
                  <tr>
                    <td><input type="checkbox" name="delete[]"  value="{{ $trade->id}}" /></td>
                    <td>{{ $no++ }}</td>
                    <td><a href="{{ route('edittrade',['id' => Crypt::encrypt($trade->id)])}}">{{ $trade->tradeCode}}</a></td>
                    <td>{{ $trade->tradeName}}</td>
                    <td>{{ $trade->tradeThMks}}</td>
                    <td>{{ $trade->tradePrMks}}</td>
                    <td>{{ $trade->tradeThPass}}</td>
                    <td>{{ $trade->tradePrPass}}</td>
                    <td>{{ $trade->tradeDur}}</td>

                    <td> <input data-id="{{$trade->id}}" class="changeStatus" type="checkbox" data-onstyle="success" data-offstyle="danger"
                     data-toggle="toggle" data-on="Active" data-off="InActive" {{ $trade->tradeStatus == 'A'? 'checked' : '' }}></td>

                
                    

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
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatusTrade',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
              toastr.info("Status changed Successfully");
            }
        });
  });
@endsection

