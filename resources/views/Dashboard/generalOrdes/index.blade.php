@extends('layouts.dashboard.app')
@section('title', 'DaPOS-orders')
@section('content')

<x-alert type="success" />

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Orders</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Status</th>
                                    <th>Total price</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <th>{{$order->id}}</th>
                                        <td>{{$order->Client->name}}</td>
                                        <td>
                                            <form action="{{route('orders.changeStatus',$order->id)}}" method="post" >
                                                @csrf
                                                <select name="status" id="" class=" {{ $order->status == "pending" ? "badge badge-warning px-2" : "badge badge-success px-2"}}" onchange="this.form.submit()">
                                                    <option value="paid" class="badge badge-success px-2" @selected($order->status == "paid")>Paid</option>
                                                    <option value="pending" class="badge badge-warning px-2" @selected($order->status == "pending")>Pending</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>{{$order->total_price}}dh</td>
                                        <td class="color-primary">{{$order->created_at->toFormattedDateString()}}</td>
                                        <td class="d-flex">
                                            {{-- <a href="{{route("clients.orders.edit", $order->Client->id, $order->id)}}" class="btn btn-warning m-1">Edit</a> --}}
                                            @if(Auth::user()->hasPermission("products-read"))
                                            <button 
                                                data-url="{{route('orders.products',$order->id)}}" 
                                                data-method="get"
                                                class="btn btn-info m-1 orders-products"
                                            >Products</button>
                                            @else
                                            <button 
                                                class="btn btn-info m-1 disabled"
                                            >Products</button>
                                            @endif
                                            @if(Auth::user()->hasPermission("orders-delete"))
                                            <form action="{{route("orders.destroy", $order->id)}}" method="POST" class="m-1 delete">
                                                @csrf
                                                @method("delete")
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                            @else
                                                <button class="btn btn-danger disabled">Delete</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Currently there is no Order</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body related-product-list">
                    <div class="card-title">
                        <h4>Related Products</h4>
                    </div>
                    {{-- related product zone --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("scripts")

<script>
    $(document).ready(function() {
        $(".orders-products").on("click", function(e) {
            
            var url = $(this).data("url")
            var method = $(this).data("method")

            // console.log(url);

            $.ajax({
                url:url,
                method:method,
                success:function(data){
                    
                    $(".related-product-list").empty()
                    $(".related-product-list").append(data)
                }
            })
        })
        $(document).on("click", ".print-order-btn", function(e){
            e.preventDefault()
            $(".print-ticket").printThis();
        })
    })
</script>
@endpush

{{-- @extends('layouts.dashboard.app')
@section('title', 'DaPOS-orders')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Orders</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Status</th>
                                    <th>Total price</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <th>{{$order->id}}</th>
                                        <td>{{$order->Client->name}}</td>
                                        <td><span class="badge badge-success px-2">paid</span>
                                        </td>
                                        <td>{{$order->total_price}}dh</td>
                                        <td class="color-primary">{{$order->created_at->toFormattedDateString()}}</td>
                                        <td class="d-flex">
                                            <a href="" class="btn btn-warning m-1">Edit</a>
                                            <form action="" method="POST" class="m-1">
                                                @csrf
                                                @method("delete")
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                            <button 
                                                data-url="{{route('orders.products',$order->id)}}" 
                                                data-method="get"
                                                class="btn btn-info m-1 orders-products"
                                            >Products</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Currently there is no Order</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$orders->Links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body related-product-list">
                    <div class="card-title">
                        <h4>Related Products</h4>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

{{-- @push("scripts")

<script>
    $(document).ready(function() {
        $(".orders-products").on("click", function(e) {
            
            var url = $(this).data("url")
            var method = $(this).data("method")

            // console.log(url);

            $.ajax({
                url:url,
                method:method,
                success:function(data){
                    
                    $(".related-product-list").empty()
                    $(".related-product-list").append(data)
                }
            })
        })
    })
</script>
@endpush --}}





