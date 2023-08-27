@extends('layouts.dashboard.app')
@section('title', 'DaPOS-product_create')
@section('content')
            <div class="container-fluid">
                <h5>Create Order</h5>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Categories</h4>
                                <p class="text-muted"><code></code>
                                </p>
                                @foreach($categories as $categroy)
                                <div id="accordion-two" class="accordion">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0" data-toggle="collapse" data-target="#{{str_replace(" ", "-", $categroy->name)}}" aria-expanded="true" aria-controls="{{str_replace(" ", "-", $categroy->name)}}"><i class="fa" aria-hidden="true"></i>{{ $categroy->name }}</h5>
                                            </div>
                                            <div id="{{str_replace(" ", "-", $categroy->name)}}" class="collapse show" data-parent="#accordion-two">
                                                <div class="card-body table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>Product</td>
                                                            <td>Name</td>
                                                            <td>Price</td>
                                                            <td>Quantity</td>
                                                            <td>Action</td>
                                                        </tr>
                                                        @foreach($categroy->products as $product)
                                                            <tr>
                                                                <td><img class="mr-3 rounded-circle" height="50px" width="50px" src="{{asset("storage/". $product->image)}}" alt=""></td>
                                                                <td>{{$product->name}}</td>
                                                                <td>{{$product->sale_price}} Dh</td>
                                                                <td>{{$product->quantity}}</td>
                                                                <td> <a 
                                                                    href="#" class="btn {{in_array($product->id, $order->products->pluck("id")->toArray()) ? "btn-default disabled" : "text-white btn-success"}}  p-2 add-product-btn"
                                                                    id="product-{{$product->id}}"
                                                                    data-name = "{{$product->name}}"
                                                                    data-id = "{{$product->id}}"
                                                                    data-price = "{{$product->sale_price}}"
                                                                    data-image = "{{$product->image}}"
                                                                    >
                                                                    +</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="{{route("clients.orders.store",$client->id)}}" method="post">
                            <div class="card">
                                    @csrf
                                    <div class="card-body">
                                        <h4 class="card-title">Orders</h4>
                                        <p class="text-muted"><code></code>
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td>Product</td>
                                                        <td>Name</td>
                                                        <td>Quantity</td>
                                                        <td>Price</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody class="order-list">

                                                </tbody>                                        
                                            </table>
                                        </div>
                                    </div>
                                
                                <hr>
                                <h3 class="total">Total:</h3>
                                <button class="btn btn-primary add-order disabled">Add Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
@push("scripts")
    <script>
        $(document).ready(function() {
            
            $(".add-product-btn").on("click", function(e){
                e.preventDefault()
                var id = $(this).data("id")
                var name = $(this).data("name")
                var price = $(this).data("price")
                var image = $(this).data("image")

                $(this).addClass("disabled")

                var html = 
                    `
                        <tr>
                            <td></td>
                            <input type="hidden" name="products[]" value="${id}" />
                            <input type="hidden" class="total_price" name="total_price" value="0" />
                            <td>${name}</td>
                            <td><input type="number" name="quantities[]" data-price="${price}" class="form-control product-quantity" value="${1}" min="1"></td>
                            <td class="product-price">${price}</td>
                            <td><button data-id="${id}" class="btn btn-danger remove-product-btn p-2">-<button/></td>
                        </tr>
                    `
                $(".order-list").append(html)

                total()
            })
        
            $("body").on("click", ".remove-product-btn", function(e){
                e.preventDefault()
                var id = $(this).data("id");

                $(this).closest("tr").remove()
                $("#product-" + id).removeClass("disabled")

                total()
            })

            $("body").on("change", ".product-quantity" , function(e){
               
                var quantity = parseInt($(this).val())
                var price = $(this).data("price")
                $(this).closest("tr").find(".product-price").html(quantity * price)
                // var productPrice = parseInt($(this).closest("tr").find(".product-price").html())

                // $(".total").html( productPrice * quantity )
                total()
            })
        })
        function total()
        {
            let price = 0;

            $(".order-list .product-price").each(function(i){

                price += parseInt($(this).html())
            })

            $(".total_price").val(price);
            
            $(".total").html(price)

            if(price > 0)
            {
                $(".add-order").removeClass("disabled")
            
            } else{
                
                $(".add-order").addClass("disabled")
            }

        }
    </script>
@endpush