@extends('layouts.dashboard.app')
@section('title', 'DaPOS-category_edit')
@section('content')
    <div class="col-lg-12 mt-3">
        <form action="{{ route('categories.update',$category->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category : {{$category->name}}</h4>
                    <div class="basic-form">
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control @error("name") is-invalid @enderror" placeholder="Name" name="name" value="{{$category->name}}">
                                    @error("name")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                    <select class="form-control form-control-lg" name="status">
                                        <option @selected($category->status == "active")>Active</option>
                                        <option @selected($category->status == "inactive")>InActive</option>
                                    </select>
                            </div>
                    </div>
                </div>
                <button class="btn btn-primary m-auto">Save</button>
            </div>
        </form>
    </div>
@endsection
