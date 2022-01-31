@extends('layouts.main')

@section('content')
<div class="header-divider"></div>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Home</span>
              </li>
              <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
          </nav>
        </div>
      </header>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <!-- <div class="row"> -->
          <form class="row g-3">
  <div class="col-md-6">
    <label class="form-label" for="inputEmail4">Email</label>
    <input class="form-control" id="inputEmail4" type="email">
  </div>
  <div class="col-md-6">
    <label class="form-label" for="inputPassword4">Password</label>
    <input class="form-control" id="inputPassword4" type="password">
  </div>
  <div class="col-12">
    <label class="form-label" for="inputAddress">Address</label>
    <input class="form-control" id="inputAddress" type="text" placeholder="1234 Main St">
  </div>
  <div class="col-12">
    <label class="form-label" for="inputAddress2">Address 2</label>
    <input class="form-control" id="inputAddress2" type="text" placeholder="Apartment, studio, or floor">
  </div>
  <div class="col-md-6">
    <label class="form-label" for="inputCity">City</label>
    <input class="form-control" id="inputCity" type="text">
  </div>
  <div class="col-md-4">
    <label class="form-label" for="inputState">State</label>
    <select class="form-select" id="inputState">
      <option selected>Choose...</option>
      <option>...</option>
    </select>
  </div>
  <div class="col-md-2">
    <label class="form-label" for="inputZip">Zip</label>
    <input class="form-control" id="inputZip" type="text">
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" id="gridCheck" type="checkbox">
      <label class="form-check-label" for="gridCheck">Check me out</label>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Sign in</button>
  </div>
</form>
          <!-- </div> -->
        </div>
    </div> 
@endsection
