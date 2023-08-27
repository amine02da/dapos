@extends('layouts.dashboard.app')
@section('title', 'DaPOS-product_create')
@section('content')
    <div class="col-lg-12 mt-3">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Product</h4>
                    <div class="basic-form">
                            @csrf
                            <div class="form-row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control @error("name") is-invalid @enderror" placeholder="Name" name="name" value="{{old("name")}}">
                                    @error("name")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control @error("purchase_price") is-invalid @enderror" placeholder="Purchase Price" name="purchase_price" value="{{old("purchase_price")}}">
                                    @error("purchase_price")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <input type="number" class="form-control @error("quantity") is-invalid @enderror" placeholder="Quantity" name="quantity" value="{{old("quantity")}}">
                                    @error("quantity")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                {{-- <div class="col">
                                    <input type="number" class="form-control @error("purchase_compare_price") is-invalid @enderror" placeholder="Purchase Compare Price" name="purchase_compare_price" value="{{old("purchase_compare_price")}}">
                                    @error("purchase_compare_price")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div> --}}
                                <div class="col">
                                    <input type="number" class="form-control @error("sale_price") is-invalid @enderror" placeholder="Sale Price" name="sale_price" value="{{old("sale_price")}}">
                                    @error("sale_price")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <input type="text" class="form-control @error("description") is-invalid @enderror" placeholder="Description" name="description" value="{{old("description")}}">
                                    @error("description")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col">
                                    <select class="form-control form-control-sm " name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" name="image">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <button class="btn btn-primary m-auto">Create</button>
            </div>
        </form>
    </div>
@endsection
