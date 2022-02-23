@extends('user_master')
@section('user_master')

@php
$t_bill = 0;
foreach ($bills as $bill)
  $t_bill = $t_bill + $bill->total;                

@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Billing</h1>
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
        <div class="col-md-6">
          <form action="user_dash" method="POST">
            @csrf
            <div class="row">
              <div class="col-sm-4">
                <h2><label for="">Select Oil Type</label></h2>
                <br>
                <select name="oil_name" id="oil_name" class="form-control form-control-lg">
                @foreach ($oils as $oil)
                  <option value="{{$oil['oil_name']}}">{{$oil['oil_name']}}</option>
                @endforeach
                </select>  
              </div>
              <div class="col-sm-4">
                <h2><label for="">Select Value</label></h2>
                <br>
                <select name="oil_value" id="oil_value" class="form-control form-control-lg">
                  <option value="Quantity">Quantity</option>
                  <option value="Taka">Taka</option>
                </select>
              </div>
              <div class="col-sm-4">
                <h2><label for="">Quantity/Taka</label></h2>
                <br>
                <input name="oil_quantity" type="text" class="form-control form-control-lg" required placeholder="Quantity/Taka">
              </div>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary">Add Product</button>
            <br><br><br><br>
          </form>
          <form action="print_bill" method="POST">
            @csrf
            <div class="row">
              <div style="margin-right: 120px" class="col-md-4">
                <h2><label>Vehicle No</label></h2>
                <br>
                <input name="vehicale_no" type="text" class="form-control form-control-lg" placeholder="Optional">
              </div>
              <div class="col-md-4">
                <h2><label>Recieved Amount</label></h2>
                <br>
                <input name="r_amount" type="text" class="form-control form-control-lg" required placeholder="Enter Recieved Amount">
              </div>
            </div>
            <br><br>
            <a id="btnprint" href="/print_bill" type="submit" class="btn btn-primary">
              <button name="print" class="btn btn-primary">Print</button>
            </a>
          </form>
        </div>
        
        <div class="col-md-6">
          <h2><label for="">Reciept Preview</label></h2>
          <br>
          <div class="row"> 
            <div class="col-sm-2">
              <h3>Name</h3>
              @foreach ($bills as $bill)
              <br>
              <h4>{{$bill['oil_name']}}</h4>
              @endforeach
            </div>
            <div class="col-sm-2">
              <h3>Price</h3>
              @foreach ($bills as $bill)
              <br>
              <h4>{{$bill['price']}}</h4>
              @endforeach
            </div>
            <div class="col-sm-2">
              <h3>Quantity</h3>
              @foreach ($bills as $bill)
              <br>
              <h4>{{$bill['qty']}}</h4>
              @endforeach
            </div>
            <div class="col-sm-2">
              <h3>Total</h3>
              @foreach ($bills as $bill)
              <br>
              <h4>{{$bill['total'].' /-'}}</h4>
              @endforeach
            </div>
            <div class="col-sm-2">
              <h3>Action</h3>
              @foreach ($bills as $bill)
              <br>
              <a href="delete_bill/{{Crypt::encrypt($bill['id'])}}" type="submit" class="btn btn-danger">Delete</a>
              <br>
              @endforeach
            </div>
            
          </div>
          <br><br>
          <div>
            <h4 style="">Total Payable :  {{$t_bill}}/-</h4>
          </div>
        </div>
      
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- Main row -->
  </section>

@endsection
  
  