@extends('layouts.dashboard.app')
@section('title', 'DaPOS-product_edit')
@section('content')
    <div class="col-lg-12 mt-3">
        <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Product : {{$product->name}}</h4>
                    <div class="basic-form">
                             @csrf
                            <div class="form-row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control @error("name") is-invalid @enderror" placeholder="Name" name="name" value="{{$product->name}}">
                                    @error("name")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control @error("purchase_price") is-invalid @enderror" placeholder="Purchase Price" name="purchase_price" value="{{$product->purchase_price}}">
                                    @error("purchase_price")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <input type="number" class="form-control @error("quantity") is-invalid @enderror" placeholder="Quantity" name="quantity" value="{{$product->quantity}}">
                                    @error("quantity")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control @error("sale_price") is-invalid @enderror" placeholder="Sale Price" name="sale_price" value="{{$product->sale_price}}">
                                    @error("sale_price")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control @error("description") is-invalid @enderror" placeholder="Description" name="description" value="{{$product->description}}">
                                    @error("description")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <select class="form-control form-control-sm " name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @selected($category->id == $product->category_id)>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" name="image">
                                        <img src="{{asset("storage/".$product->image)}}" class="rounded-cercle" alt="{{$product->name}}" width="100px" height="100px">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <button class="btn btn-primary m-auto">Save</button>
            </div>
        </form>
    </div>
@endsection
