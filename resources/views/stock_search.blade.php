@extends('master')
@section('master')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Search Stock Reports</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
    <!-- /.content-header -->
  
  <!-- Main content -->
  
    <section class="content">
        <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12">
              <div class="row">
                <a href="/stock_search/exports" name="submit" type="submit" class="btn btn-success">Download</a>
                
                <a style="margin-left: 20px" href="/stock_reports" name="submit" type="submit" class="btn btn-primary">Back</a>
              </div>
            </form>
              <br>  
              <div style="position: relative;
              height: 600px;
              overflow: auto;">    
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Oil Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Entry Date</th>
                    <th scope="col">Entry Time</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($stocks as $stock)
                  @php
                    $temp = explode(' ',$stock->created_at);    
                  @endphp
                  <tr>
                    <th scope="row">{{$stock->id}}</th>
                    <td>{{$stock->oil_name}}</td>
                    <td>{{$stock->qty}}</td>
                    <td>{{$temp[0]}}</td>
                    <td>{{$temp[1]}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
              {{-- <span class="pag">
                {{ $stocks->links('pagination::bootstrap-4') }}
              </span> --}}
            </div>
        </div>
        <!-- /.row -->
      </div>  
        <!-- Main row -->
    </section>
    <style>
      .w-5{
          display: none;
      }
      .pag{
        /* float: right;? */
        position: fixed;
        bottom: 1.2cm
      }
  </style>
  
  @endsection