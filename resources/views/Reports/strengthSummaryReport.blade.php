
@extends('layouts.main')

@section('content')
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  background-color: #e3e3dc;
  border-collapse: collapse;
  /* width: auto;
    margin-right: 263px;
    margin-left: auto;*/
}

table, th, td {
  border: 3px solid black;
  border-collapse: collapse;
  
}

td, th {
  border: -1px solid #dddddd;
  text-align: left;
  padding: 6px;
}


/*tr:nth-child(even) {
  background-color: #dddddd;
}*/

</style>
<style>
  * {
    box-sizing: border-box;
    }

  .row::after {
    content: "";
    clear: both;
    display: table;
  }

  [class*="col-"] {
    float: left;
    padding: 15px;
  }

  html {
    font-family: "Lucida Sans", sans-serif;
  }

  .header {
    color: black;
    padding: 15px;
  }

  .menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }

  .menu li {
    padding: 8px;
    margin-bottom: 7px;
    background-color: #33b5e5;
    color: #ffffff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  }

  .menu li:hover {
    background-color: #0099cc;
  }

  .aside {
    background-color: #33b5e5;
    padding: 15px;
    color: #ffffff;
    text-align: center;
    font-size: 14px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  }


  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }

  @media only screen and (min-width: 600px) {
    /* For tablets: */
    .col-s-1 {width: 8.33%;}
    .col-s-2 {width: 16.66%;}
    .col-s-3 {width: 25%;}
    .col-s-4 {width: 33.33%;}
    .col-s-5 {width: 41.66%;}
    .col-s-6 {width: 50%;}
    .col-s-7 {width: 58.33%;}
    .col-s-8 {width: 66.66%;}
    .col-s-9 {width: 75%;}
    .col-s-10 {width: 83.33%;}
    .col-s-11 {width: 91.66%;}
    .col-s-12 {width: 100%;}
  }
  @media only screen and (min-width: 768px) {
    /* For desktop: */
    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}
  }
</style>
<style>
  * {
    box-sizing: border-box;
    }

  .row::after {
    content: "";
    clear: both;
    display: table;
  }

  [class*="col-"] {
    float: left;
    padding: 15px;
  }

  html {
    font-family: "Lucida Sans", sans-serif;
  }

  .header {
    color: black;
    padding: 15px;
  }

  .menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
  }

  .menu li {
    padding: 8px;
    margin-bottom: 7px;
    background-color: #33b5e5;
    color: #ffffff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  }

  .menu li:hover {
    background-color: #0099cc;
  }

  .aside {
    background-color: #33b5e5;
    padding: 15px;
    color: #ffffff;
    text-align: center;
    font-size: 14px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  }


  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }

  @media only screen and (min-width: 600px) {
    /* For tablets: */
    .col-s-1 {width: 8.33%;}
    .col-s-2 {width: 16.66%;}
    .col-s-3 {width: 25%;}
    .col-s-4 {width: 33.33%;}
    .col-s-5 {width: 41.66%;}
    .col-s-6 {width: 50%;}
    .col-s-7 {width: 58.33%;}
    .col-s-8 {width: 66.66%;}
    .col-s-9 {width: 75%;}
    .col-s-10 {width: 83.33%;}
    .col-s-11 {width: 91.66%;}
    .col-s-12 {width: 100%;}
  }
  @media only screen and (min-width: 768px) {
    /* For desktop: */
    .col-1 {width: 8.33%;}
    .col-2 {width: 16.66%;}
    .col-3 {width: 25%;}
    .col-4 {width: 33.33%;}
    .col-5 {width: 41.66%;}
    .col-6 {width: 50%;}
    .col-7 {width: 58.33%;}
    .col-8 {width: 66.66%;}
    .col-9 {width: 75%;}
    .col-10 {width: 83.33%;}
    .col-11 {width: 91.66%;}
    .col-12 {width: 100%;}
  }
</style>

</head>

<div class="col-md-6 col-s-12" style="text-align: center;">
  <h3>SCE-Strength Summary For The Session:December,2022</h3>
  <h5>Trade Testing Board,Punjab,Lahore</h5>
  <h3>SHORT COURSE 6 MONTHS</h3>
  <h5>District:ALL Zone:ALL Shift/Group:E Duration:06Months</h5>
</div>

<table>
  <tr>
    <th><b>Sr No.</b></th>
    <th><b>CENTRE NAME</b></th>
    <th><b>DIST NAME</b></th>
    <th><b>ZONE</b></th>
    <th><b>CENTRE CODE</b></th>
    <th><b>2D & 3D DRAFTING USING AUTO CAD</b></th>
    <td><b>ADDA WORK</b></td>
    <td><b>ADVANCE MAIL</b></td>
    <td><b>AIR TICKETING</b></td>
    <td><b>ALUMINUM & STEEL FABRICATOR</b></td>
    <td><b>ASSET HEALTH MANAGEMENT</b></td>
    <td><b>TOTAL</b></td>
  </tr>
  <tr>
    <td>1</td>
    <td>Lahore</td>
    <td>A01</td>
    <td>12</td>
    <td>10</td>
    <td>0</td> 
    <td colspan="5">1</td>
    <td>0</td>
  </tr>
  <tr>
    <td>2</td>
    <td>Lahore</td>
    <td>A01</td>
    <td>12</td>
    <td>10</td>
    <td>0</td>
    <td>1</td>
    <td>Lahore</td>
    <td>A01</td>
    <td>12</td>
    <td>10</td>
    <td>0</td> 
  </tr>
</table>
@endsection