<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Oil Name</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
        @php
        $temp = explode(' ',$stock->created_at);    
        @endphp
            <tr>
                <td>{{$stock->id}}</td>
                <td>{{$stock->oil_name}}</td>
                <td>{{$stock->qty}}</td>
                <td>{{$temp[0]}}</td>
                <td>{{$temp[1]}}</td>  
            </tr>    
        @endforeach
    </tbody>
</table>