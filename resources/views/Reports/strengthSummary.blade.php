@extends('layouts.main')
@section('title', 'Users List')
@section('content')
<div class="header-divider"></div>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <!-- if breadcrumb is single--><span>Home</span>
      </li>
      <li class="breadcrumb-item active"><span>List of Trade</span></li>
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
            <div class="card-header">List of Trade</div>
            <div class="card-body">

            <table id="example" class="table striped" >
                <thead>
                  <tr>
                    <th></th>
                    <th>Nr</th>
                    <th>Trade Code</th>
                    <th>Tarde Name</th>
                    <th>Theory Marks</th>
                    <th>Practical Marks</th>
                    <th>Theory Passing</th>
                    <th>Practical Passing</th>
                    <th>Duration</th>
                    <th>Active</th>

                  </tr>
                </thead>
                <tbody>
             
                  <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>1</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
                       <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>2</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
                       <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>3</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
                       <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>4</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
                       <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>5</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
                       <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>6</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
                       <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>7</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
                       <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>8</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
                       <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>9</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
                       <tr>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                    <td>10</td>
                    <td>A10</td>
                    <td>IT</td>
                    <td>12</td>
                    <td>10</td>
                    <td>0</td>
                    <td>0</td>
                    <td>13</td>
                    <td><input type="checkbox" id="checkbox" name="checkbox" /></td>
                  </tr>
        
                </tbody>
            </table>
            </div>
        </div>
    </div>
  </div>
</div> 

@endsection

@section('javascript')

  $(document).ready(function() {
      $('#example').DataTable();
  } );

@endsection

