@extends('layouts.dashboard.app')
@section('title', 'DaPOS-client_edit')
@section('content')
    <div class="col-lg-12 mt-3">
        <form action="{{ route('clients.update',$client->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User : {{$client->name}}</h4>
                    <div class="basic-form">
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control @error("name") is-invalid @enderror" name="name" value="{{$client->name}}">
                                    @error("name")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Address" name="address" value="{{$client->address}}">
                                </div>
                            </div>
                            <div class="mt-2 form-row">
                                <div class="col">
                                    <input type="tel" class="form-control @error("phone") is-invalid @enderror" name="phone" value="{{$client->phone}}">
                                    @error("phone")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>
                <button class="btn btn-primary m-auto">Save</button>
            </div>
        </form>
    </div>
@endsection
