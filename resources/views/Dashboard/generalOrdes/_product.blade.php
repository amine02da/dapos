<div class="table-responsive">
    <div class="table print-ticket">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td><img src="{{asset("storage/". $product->image)}}" alt="$product->name" width="50px" height="50px"></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->pivot->quantity}}</td>
                        <td>{{$product->sale_price}}dh</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4>Total: {{$order->total_price}}dh</h4>
    </div>
    <button class="btn btn-info print-order-btn">Print</button>
</div>