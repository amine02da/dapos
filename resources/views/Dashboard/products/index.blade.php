@extends("layouts.dashboard.app")
@section("title", "DaPOS-products")
@section("content")

<x-alert type="success" />

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <form action="{{route("products.index")}}" method="get" class="d-flex">
                                <input type="text" name="name" placeholder="search for products" class="form-control form-control-sm m-1" value="{{request()->name}}">
                                <button class="btn btn-primary sweet-confirm m-1">search</button>
                            </form>
                        </div>
                        <div>
                            @if(Auth::user()->hasPermission("products-create"))
                                <a href="{{route("products.create")}}"  class="btn btn-primary">Create New Product</a>
                            @else
                                <button class="btn btn-primary" disabled> Create New Product</button>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Purchase Price</th>
                                    <th>Sale Price</th>
                                    <th>Quantity</th>
                                    <th>Description</th>
                                    <th>Profit Percent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td><img src="{{asset("storage/".$product->image)}}" class="rounded-cercle" alt="{{$product->name}}" width="100px" height="100px"></td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->purchase_price}}dh</td>
                                        <td>{{$product->sale_price}}dh</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->ProfitPercent}} %</td>
                                        <td class="color-primary d-flex">
                                            @if(Auth::user()->hasPermission("categories-update"))
                                                <a href="{{route("products.edit",$product->id)}}" class="btn m-1 mb-1 btn-info">Edit</a>
                                            @else
                                            <button class="btn btn-info m-1" disabled>Edit</button>
                                            @endif
                                                <form action="{{route("products.destroy",$product->id)}}" method="POST" class="delete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn mb-1 btn-danger m-1 " @disabled(Auth::user()->hasPermission("products-delete") == false)>Delete</button>
                                                </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Currently there is no product</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$products->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



