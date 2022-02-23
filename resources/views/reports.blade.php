@extends('master')
@section('master')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Stocks</h1>
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
            <div class="col-lg-3 col-6">    
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                    <h3>Stock</h3>
                    <p style="font-size: 30px">Reports</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-podium"></i>
                    </div>
                    <a href="/stock_reports" class="small-box-footer">Detail Reports <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">    
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                    <h3>Billing</h3>
                    <p style="font-size: 30px">Reports</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-calculator"></i>
                    </div>
                    <a href="/billing_reports" class="small-box-footer">Detail Reports <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        </div>  
        <!-- Main row -->
    </section>
  @endsection