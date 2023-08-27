@extends('layouts.dashboard.app')
@section('title', 'DaPOS-client_create')
@section('content')
    <div class="col-lg-12 mt-3">
        <form action="{{ route('clients.store') }}" method="post">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Client</h4>
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
                            <div class="mt-2 form-row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Address" name="address" value="{{old("address")}}">
                                </div>
                            </div>
                            <div class="mt-2 form-row">
                                <div class="col">
                                    <input type="tel" class="form-control @error("phone") is-invalid @enderror" placeholder="Phone" name="phone" value="{{old("phone")}}">
                                    @error("phone")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>
                <button class="btn btn-primary m-auto">Create</button>
            </div>
        </form>
    </div>
@endsection
