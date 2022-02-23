@extends('master')
@section('master')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Update Stock</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
    <!-- /.content-header -->
  <br><br>
  <!-- Main content -->
  
    <section class="content">
        <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-4">
                <!-- small box -->
                <h1>Oil Type :  {{$stock['oil_name']}}</h1>
                <br>
                <h3>Current Liter : {{$stock['cur_ltr']." Ltr"}}</h3>
                <br>
                <form action="/update_stock" method="POST">
                  @csrf
                  <h3>Add New Stock</h3>
                  <br>
                  <input type="hidden" name="id" value="{{$stock['id']}}">
                  <input type="text" class="form-control form-control-lg" name="new_stock" placeholder="Add New Stock (LTR)" />
                  <br>
                  <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
                
        </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        </div>  
        <!-- Main row -->
    </section>
  @endsection
 
  