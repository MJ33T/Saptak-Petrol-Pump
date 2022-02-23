<table class="table">
    <thead>
      <col>
      <colgroup span="5"></colgroup>
      <colgroup span="5"></colgroup>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th style="text-align: center" colspan="5" scope="colgroup">Diesel-1</th>
        <th style="text-align: center" colspan="5" scope="colgroup">Diesel-2</th>
        <th style="text-align: center" colspan="5" scope="colgroup">Petrol</th>
        <th style="text-align: center" colspan="5" scope="colgroup">Octane</th>
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
        <th scope="col">Commission</th>
        <th scope="col">Sub Total</th>
        <th scope="col">Depreciate</th>
        <th scope="col">Unit</th>
        <th scope="col">Price</th>
        <th scope="col">Commission</th>
        <th scope="col">Sub Total</th>
        <th scope="col">Depreciate</th>
        <th scope="col">Unit</th>
        <th scope="col">Price</th>
        <th scope="col">Commission</th>
        <th scope="col">Sub Total</th>
        <th scope="col">Depreciate</th>
        <th scope="col">Unit</th>
        <th scope="col">Price</th>
        <th scope="col">Commission</th>
        <th scope="col">Sub Total</th>
        <th scope="col">Depreciate</th>
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
        <td>{{$bill->d_commision_1}}</td>
        <td>{{$bill->d_subtotal_1}}</td>
        <td>{{$bill->d_depriciate_1}}</td>
        <td>{{$bill->d_quantity_2}}</td>
        <td>{{$bill->d_unit_price_2}}</td>
        <td>{{$bill->d_commision_2}}</td>
        <td>{{$bill->d_subtotal_2}}</td>
        <td>{{$bill->d_depriciate_2}}</td>
        <td>{{$bill->p_quantity}}</td>
        <td>{{$bill->p_unit_price}}</td>
        <td>{{$bill->p_commision}}</td>
        <td>{{$bill->p_subtotal}}</td>
        <td>{{$bill->p_depriciate}}</td>
        <td>{{$bill->o_quantity}}</td>
        <td>{{$bill->o_unit_price}}</td>
        <td>{{$bill->o_commision}}</td>
        <td>{{$bill->o_subtotal}}</td>
        <td>{{$bill->o_depriciate}}</td>
        <td>{{$bill->l_quantity}}</td>
        <td>{{$bill->l_unit_price}}</td>
        <td>{{$bill->l_subtotal}}</td>
        <td>{{$bill->grandtotal}}</td>
        
      </tr>
      @endforeach
    </tbody>
  </table>