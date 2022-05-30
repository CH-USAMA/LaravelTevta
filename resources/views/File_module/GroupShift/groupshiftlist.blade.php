@extends('layouts.main')
@section('title', 'Group Shift')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
      </li>
      <li class="breadcrumb-item active"><span>Group Shift Codes</span></li>
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
            <input type="hidden" name="table" value="groupp">
            <div class="card-header">List of Group Shift <a href="{{ route('addgroupshift') }}" class="btn btn-secondary" style="float:right;">Add Group Shift</a><button type="submit" class="btn btn-secondary" style="float:right;  margin-right: 10px;">Remove Selected</button><br><br></div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                  <th></th>
                    <th>Nr</th>
                    <th>Group / Shift Name</th>
                   
                  </tr>
                </thead>
                <tbody>

                  @foreach($groupshifts as $groupshift)
                  
                  <tr>
                    <td><input type="checkbox" name="delete[]"  value="{{ $groupshift->id}}" /></td>
                    <td>{{ $no++ }}</td>
                    <td><a href="{{ route('editgroupshift',['id' => Crypt::encrypt($groupshift->id)])}}">{{ $groupshift->groupName}}</a></td>
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

@endsection

