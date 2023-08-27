@extends('layouts.dashboard.app')
@section('title', 'DaPOS-user_edit')
@section('content')
    <div class="col-lg-12 mt-3">
        <form action="{{ route('users.update',$user->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User : {{$user->first_name}}</h4>
                    <div class="basic-form">
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control @error("first_name") is-invalid @enderror" placeholder="First name" name="first_name" value="{{$user->first_name}}">
                                    @error("first_name")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Last name" name="last_name" value="{{$user->last_name}}">
                                </div>
                            </div>
                            <div class="mt-2 form-row">
                                <div class="col">
                                    <input type="email" class="form-control @error("email") is-invalid @enderror" placeholder="Email" name="email" value="{{$user->email}}">
                                    @error("email")
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @php
                                $models = ["users", "categories", "products", "clients", "orders"];    
                                $map = ["create", "read", "update", "delete"];
                            @endphp
                            <h4 class="card-title">Permissions</h4>
                            <ul class="nav nav-pills mb-3">
                                @foreach($models as $i => $model)
                                <li class="nav-item"><a href="#{{$model}}" class="{{$i == 0 ? "nav-link active" : "nav-link"}}" data-toggle="tab"
                                        aria-expanded="false">{{$model}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content br-n pn">
                                @foreach($models as $i => $model)
                                    <div id="{{$model}}" class="{{$i == 1 ? "tab-pane active" : "tab-pane"}}">
                                        <div class="row align-items-center">
                                            <div class="col-sm-6 col-md-4 col-xl-2">
                                                <img src="images/big/card-4.png" alt="" class="img-fluid thumbnail m-r-15">
                                            </div>
                                            <div class="col-sm-6 col-md-8 col-xl-10">
                                                <div class="basic-form">
                                                        <div class="form-group">
                                                            @foreach($map as $i => $item)
                                                                <div class="form-check form-check-inline">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox" name="permissions[]" class="form-check-input"
                                                                        @checked($user->hasPermission($model."-". $item))
                                                                            value={{$model."-".$item}}>{{$item}}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div id="navpills-2" class="tab-pane">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 col-md-4 col-xl-2">
                                            <img src="images/big/card-3.png" alt="" class="img-fluid thumbnail m-r-15">
                                        </div>
                                        <div class="col-sm-6 col-md-8 col-xl-10">
                                            <p>Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh
                                                mi, qui irure terry richardson ex squid.</p>
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                                stumptown aliqua, retro synth master cleanse. Mustache cliche tempor,
                                                williamsburg carles vegan helvetica.</p>
                                        </div>
                                    </div>
                                </div>
                                <div id="navpills-3" class="tab-pane">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 col-md-4 col-xl-2">
                                            <img src="images/big/card-1.png" alt="" class="img-fluid thumbnail m-r-15">
                                        </div>
                                        <div class="col-sm-6 col-md-8 col-xl-10">
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                                stumptown aliqua, retro synth master cleanse. Mustache cliche tempor,
                                                williamsburg carles vegan helvetica.</p>
                                            <p>Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh
                                                mi, qui irure terry richardson ex squid.</p>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        @error("permissions")
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary m-auto">Save</button>
            </div>
        </form>
    </div>
@endsection
