@extends('master')
@section('master')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Current Oil Price</h1>
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
            @foreach ($oils as $oil)
            <div class="col-lg-3 col-6">
                
                <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$oil['price']."/-"}}</h3>
                <p style="font-size: 30px">{{$oil['oil_name']}}</p>
                </div>
                <div class="icon">
                <i class="ion ion-flame"></i>
                </div>
                <a href="/update_oil/{{Crypt::encrypt($oil['id'])}}" class="small-box-footer">Change Price <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            @endforeach
            <!-- ./col -->
        </div>
        <!-- /.row -->
        </div>  
        <!-- Main row -->
    </section>
  @endsection
 
  