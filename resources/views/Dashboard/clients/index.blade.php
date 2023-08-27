@extends("layouts.dashboard.app")
@section("title", "DaPOS-clients")
@section("content")

<x-alert type="success" />

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <form action="{{route("clients.index")}}" method="get" class="d-flex">
                                <input type="text" name="name" placeholder="search for Client" class="form-control form-control-sm m-1" value="{{request()->name}}">
                                <button class="btn btn-primary sweet-confirm m-1">search</button>
                            </form>
                        </div>
                        <div>
                            @if(Auth::user()->hasPermission("clients-create"))
                                <a href="{{route("clients.create")}}"  class="btn btn-primary">Create New Client</a>
                            @else
                                <button class="btn btn-primary" disabled> Create New Client</button>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Orders</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clients as $client)
                                    <tr>
                                        <td>{{$client->id}}</td>
                                        <td>{{$client->name}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td>{{$client->address}}</td>
                                        <td>
                                            @if(Auth::user()->hasPermission("orders-create"))
                                                <a href="{{route('clients.orders.create', $client->id)}}" class="btn btn-dark">Add Order</a>
                                            @else
                                                <a href="#" class="btn btn-dark" disabled>Add Order</a>
                                            @endif
                                        </td>
                                        <td class="color-primary d-flex">
                                            @if(Auth::user()->hasPermission("clients-update"))
                                                <a href="{{route("clients.edit",$client->id)}}" class="btn m-1 mb-1 btn-info">Edit</a>
                                            @else
                                            <button class="btn btn-info m-1" disabled>Edit</button>
                                            @endif
                                                <form action="{{route("clients.destroy",$client->id)}}" method="POST" class="delete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn mb-1 btn-danger m-1 " @disabled(Auth::user()->hasPermission("clients-delete") == false) >Delete</button>
                                                </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Currently there is no client</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$clients->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

