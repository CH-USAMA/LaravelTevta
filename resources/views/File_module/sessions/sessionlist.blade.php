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
            <div class="card-header">List of Sessions <a href="{{ route('newSession') }}" class="btn btn-secondary" style="float:right;">Add Session</a><br><br></div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                    <th>Nr</th>
                    <th>Session Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($sessions as $session)
                  
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td><a href="{{ route('editSession',['id' => Crypt::encrypt($session->id)])}}">{{ $session->s_name}}</a></td>
                    <td>{{ $session->s_start_date}}</td>
                    <td>{{ $session->s_end_date}}</td>
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

