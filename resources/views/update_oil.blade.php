@extends('master')
@section('master')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Update Oil Price</h1>
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
                <h1>Oil Type :  {{$oil['oil_name']}}</h1>
                <br>
                <h3>Current Price : {{$oil['price']."/- (BDT)"}}</h3>
                <br>
                <form action="/update_oil" method="POST">
                  @csrf
                  <h3>Update Price</h3>
                  <br>
                  <input type="hidden" name="id" value="{{$oil['id']}}">
                  <input type="text" class="form-control form-control-lg" name="update_oil" placeholder="Set New Rate" />
                  <br>
                  <button type="submit" class="btn btn-primary">Update</button>
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
 
  