@php
    $grand_total = 0;
    // $date = date("d-m-Y h:i:sa");
    // $date = $bills->created_at[0];
@endphp

<div class="ticket">
    
    <img src="{{$pic}}" width="220px" height="68px">
    <div style="margin-bottom: 20px">
        <br>Inovice No : {{$invoice}}
        <br>Purchase Date : {{$time}}
        <br>Vehicle No : {{$calculation->v_no}}
    </div>
    
    <div>
        <table>
            <thead>
                <tr>
                    <th >Quantity</th>
                    <th >Description</th>
                    <th >Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills as $bill)
                <tr>
                    <td>{{$bill->qty}} Ltr</td>
                    <td>
                        @if($bill->oil_name == 'Diesel-1' || $bill->oil_name == 'Diesel-2')
                            {{'Diesel'}}
                            {{'('.$bill->price.')'}}
                        @else
                            {{$bill->oil_name}}
                            {{'('.$bill->price.')'}}
                        @endif
                    </td>
                    <td class="price">{{$bill->total}}/-</td>
                </tr>
                @php $grand_total = $grand_total + $bill->total @endphp
                @endforeach
                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><br>Total</td>
                    <td><br>{{$grand_total}}/-</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Recieved</td>
                    <td>{{$calculation->r_amount}}/-</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Return</td>
                    <td>{{$calculation->ret_amount}}/-</td>
                </tr>
                <tr>
                    <td></td>
                    <td>OTHERS</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
        <p style="font-size: .7em">"Thank you for your purchase. For any query, please call 01777785765. N.B : Goods once sold cannot be returned."</p>
            
</div>

