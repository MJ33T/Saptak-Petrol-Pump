@extends('master')
@section('master')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Bill Reports</h1>
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
                <a href="/billing_search/exports" name="submit" type="submit" class="btn btn-success">Download</a>
                
                <a style="margin-left: 20px" href="/billing_reports" name="submit" type="submit" class="btn btn-primary">Back</a>
              </div>
            </form>
              <br>  
              <div style="position: relative;
              height: 600px;
              overflow: auto;">    
              <table class="table">
                <thead>
                  <col>
                  <colgroup span="3"></colgroup>
                  <colgroup span="3"></colgroup>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="text-align: center" colspan="3" scope="colgroup">Diesel-1</th>
                    <th style="text-align: center" colspan="3" scope="colgroup">Diesel-2</th>
                    <th style="text-align: center" colspan="3" scope="colgroup">Petrol</th>
                    <th style="text-align: center" colspan="3" scope="colgroup">Octane</th>
                    <th style="text-align: center" colspan="3" scope="colgroup">Lub</th>
                    <th></th>
                  </tr>
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Invoice No</th>
                    <th scope="col">User</th>
                    <th scope="col">Vehicle</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Grand Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($bills as $bill)
                  @php
                    $temp = explode(' ',$bill->created_at);    
                  @endphp
                  <tr>
                    <td>{{$temp[0]}}</td>
                    <td>{{$temp[1]}}</td>
                    <td>{{$bill->invoice_no}}</td>
                    <td>{{$bill->user}}</td>
                    <td>{{$bill->vehicle}}</td>
                    <td>{{$bill->d_quantity_1}}</td>
                    <td>{{$bill->d_unit_price_1}}</td>
                    <td>{{$bill->d_subtotal_1}}</td>
                    <td>{{$bill->d_quantity_2}}</td>
                    <td>{{$bill->d_unit_price_2}}</td>
                    <td>{{$bill->d_subtotal_2}}</td>
                    <td>{{$bill->p_quantity}}</td>
                    <td>{{$bill->p_unit_price}}</td>
                    <td>{{$bill->p_subtotal}}</td>
                    <td>{{$bill->o_quantity}}</td>
                    <td>{{$bill->o_unit_price}}</td>
                    <td>{{$bill->o_subtotal}}</td>
                    <td>{{$bill->l_quantity}}</td>
                    <td>{{$bill->l_unit_price}}</td>
                    <td>{{$bill->l_subtotal}}</td>
                    <td>{{$bill->grandtotal}}</td>
                    
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>  
              {{-- <span class="pag">
                {{ $bills->links('pagination::bootstrap-4') }}
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