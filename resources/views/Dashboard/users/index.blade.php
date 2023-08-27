@extends("layouts.dashboard.app")
@section("title", "DaPOS-dashboard")
@section("content")

<x-alert type="success" />

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <form action="{{route("users.index")}}" method="get" class="d-flex">
                                <input type="text" name="user" placeholder="search for user" class="form-control form-control-sm m-1" value="{{request()->user}}">
                                <button class="btn btn-primary sweet-confirm m-1">search</button>
                            </form>
                        </div>
                        <div>
                            @if(Auth::user()->hasPermission("users-create"))
                                <a href="{{route("users.create")}}"  class="btn btn-primary">Create New User</a>
                            @else
                                <button class="btn btn-primary" disabled> Create New User</button>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td class="color-primary d-flex">
                                            @if(Auth::user()->hasPermission("users-update"))
                                                <a href="{{route("users.edit",$user->id)}}" class="btn m-1 mb-1 btn-info">Edit</a>
                                            @else
                                            <button class="btn btn-info m-1" disabled>Edit</button>
                                            @endif
                                                <form action="{{route("users.destroy",$user->id)}}" method="POST" class="delete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn mb-1 btn-danger m-1 " @disabled(Auth::user()->hasPermission("users-delete") == false) >Delete</button>
                                                </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Currently there is no user</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$users->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

