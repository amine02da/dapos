@extends("layouts.dashboard.app")
@section("title", "DaPOS-categories")
@section("content")

<x-alert type="success" />

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <form action="{{route("categories.index")}}" method="get" class="d-flex">
                                <input type="text" name="name" placeholder="search for categories" class="form-control form-control-sm m-1" value="{{request()->name}}">
                                <button class="btn btn-primary sweet-confirm m-1">search</button>
                            </form>
                        </div>
                        <div>
                            @if(Auth::user()->hasPermission("categories-create"))
                                <a href="{{route("categories.create")}}"  class="btn btn-primary">Create New Category</a>
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
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>The Number of Related products</th>
                                    <th>Related products</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr class="text-center">
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->status}}</td>
                                        <td>{{$category->products->count()}}</td>
                                        <td><a href="{{route("products.index",["category_id" => $category->id])}}" class="btn btn-dark">Show</a></td>
                                        <td class="color-primary d-flex">
                                            @if(Auth::user()->hasPermission("categories-update"))
                                                <a href="{{route("categories.edit",$category->id)}}" class="btn m-1 mb-1 btn-info">Edit</a>
                                            @else
                                            <button class="btn btn-info m-1" disabled>Edit</button>
                                            @endif
                                                <form action="{{route("categories.destroy",$category->id)}}" method="POST" class="delete">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn mb-1 btn-danger m-1 " @disabled(Auth::user()->hasPermission("categories-delete") == false)>Delete</button>
                                                </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Currently there is no category</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{$categories->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

