@extends('layouts.dashboard.app')
@section('title', 'DaPOS-category_create')
@section('content')
    <div class="col-lg-12 mt-3">
        <form action="{{ route('categories.store') }}" method="post">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Category</h4>
                    <div class="basic-form">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control @error("name") is-invalid @enderror" placeholder="Name" name="name" value="{{old("name")}}">
                                    @error("name")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                                <div class="form-group mt-3">
                                    <select class="form-control form-control-lg" name="status">
                                        <option>Active</option>
                                        <option>InActive</option>
                                    </select>
                                </div>
                    </div>
                </div>

                <button class="btn btn-primary m-auto">Create</button>
            </div>
        </form>
    </div>
@endsection
