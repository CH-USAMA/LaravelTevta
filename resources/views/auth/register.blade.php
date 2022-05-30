@extends('layouts.main')

@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>User</span>
      </li>
      <li class="breadcrumb-item active"><span>Add</span></li>
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
            <div class="card-header">Add User</div>
            <div class="card-body">
      <form class="row g-3" method="POST" action="{{ route('register') }}">
       @csrf
       <div class="col-md-6">
        <label class="form-label" for="username">User ID</label>
        <input name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" autofocus id="username" type="text">
        @error('username')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-md-6">
        <label class="form-label" for="password">Password</label>
        <input name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required autocomplete="new-password" autofocus  id="password" type="password">
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      @php
      $roles = \Spatie\Permission\Models\Role::where('status','Active')->get();
      @endphp
      <div class="col-md-6">
        <label class="form-label" for="role">User Type</label>
        <select name="role" class="form-select @error('role') is-invalid @enderror" required id="role">
          <option disabled selected>Choose...</option>
          @foreach($roles as $role)
            <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
          @endforeach
        </select>
         @error('role')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

       <div class="col-md-6">
        <label class="form-label" for="first_name">First Name</label>
        <input name="first_name" class="form-control @error('first_name') is-invalid @enderror"value="{{ old('first_name') }}" required autocomplete="first_name" autofocus id="first_name" type="text">
        @error('first_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-md-6">
        <label class="form-label" for="last_name">Last Name</label>
        <input name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus id="last_name" type="text">
        @error('last_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-md-6">
        <label class="form-label" for="email">Email</label>
        <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus  id="email" type="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="col-md-6">
        <label class="form-label" for="phone">Telephone</label>
        <input name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required autocomplete="phone" autofocus id="phone" type="tel">
        @error('phone')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      

      <div class="col-md-6">
      <label class="form-label" for="phone"></label>
        <div class="form-check">
          <input class="form-check-input" id="status" type="checkbox" name="status" value="active">
          <label class="form-check-label" for="status">Active/InActive</label>
        </div>
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="submit">OK</button>
        <button class="btn btn-primary" type="reset">Reset</button>

      </div>
    </form>
       
    </div>
        </div>
    </div>
    <!-- </div> -->
  </div>
</div> 
@endsection