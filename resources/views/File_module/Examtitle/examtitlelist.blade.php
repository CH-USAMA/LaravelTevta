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
      <li class="breadcrumb-item active"><span>Exam Title</span></li>
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
            <input type="hidden" name="table" value="examtitle">
            <div class="card-header">List of Exam Titles <a href="{{ route('addexamtitle') }}" class="btn btn-secondary" style="float:right;">Add Exam Title</a><button type="submit" class="btn btn-secondary" style="float:right;  margin-right: 10px;">Remove Selected Title</button><br><br></div>

            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                  <th></th>
                    <th>Nr</th>
                    <th>Exam Title</th>
                    <th>Theory Marks</th>
                    <th>Practical Marks</th>
                    <th>Theory Pass Marks</th>
                    <th>Practical Pass Marks</th>
                    <th>Duration</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($examtitles as $examtitle)
                  
                  <tr>
                    <td><input type="checkbox" name="delete[]"  value="{{ $examtitle->id}}" /></td>
                    <td>{{ $no++ }}</td>
                    <td><a href="{{ route('editexamtitle',['id' => Crypt::encrypt($examtitle->id)])}}">{{ $examtitle->titleName}}</a></td>
                    <td>{{ $examtitle->exThMks}}</td>
                    <td>{{ $examtitle->exPrMks}}</td>
                    <td>{{ $examtitle->exThPass}}</td>
                    <td>{{ $examtitle->exPrPass}}</td>
                    <td>{{ $examtitle->exDur}}</td>
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

@endsection

