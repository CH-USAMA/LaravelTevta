@extends('layouts.main')
@section('title', 'Add Group Shift')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>File Maintenance</span>
      </li>
      <li class="breadcrumb-item active"><span>Add Group Shift</span></li>
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
            @isset($group)
            <div class="card-header">Edit Group Shift</div>
            @else
            <div class="card-header">Add Group Shift</div>
            @endisset
            <div class="card-body">
              <!-- content here -->
              <div class="body flex-grow-1 px-3">
                <div class="container-lg">
                @isset($group)
                <form class="row g-3" method="POST" action="{{ route('updategroupshift')}}">
                @else
                <form class="row g-3" method="POST" action="{{ route('savegroupshift')}}">
                @endisset
               
                    @csrf
                    <input type="hidden" name="id" value="{{ $group->id ?? '' }}">
                    <div class="col-md-6">
                        <label class="form-label" for="groupName">Group/Shift</label>
                        <input class="form-control @error('groupName') is-invalid @enderror" id="groupName" type="text" name="groupName" value="{{ $group->groupName ?? '' }}">
                    </div>
                    @error('groupName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach 

                      
                       <div class="col-12">
                       @isset($group)
                       <button class="btn btn-primary" type="submit">Update Group Shift</button>
                      @else
                      <button class="btn btn-primary" type="submit">Add Group Shift</button>
                      @endisset
                        
                    </div>
                    </form>
                </div>
            </div> 
              <!-- ----- -->
            </div>
        </div>
    </div>

     
    <!-- </div> -->
  </div>
</div> 
@endsection