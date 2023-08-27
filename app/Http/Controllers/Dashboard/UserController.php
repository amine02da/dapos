<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(["permission:users-create"])->only("create");
        $this->middleware(["permission:users-read"])->only("index");
        $this->middleware(["permission:users-update"])->only("edit");
        $this->middleware(["permission:users-delete"])->only("destroy");
    }
    public function index(Request $request)
    {
        $query = User::query();

        if($user = $request->query("user")){
            $query->where("last_name", "like", "%{$request->user}%");
        }

        $users = $query->whereRoleIs("admin")->paginate(4);
        return view("dashboard.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(User::rules());
        $new_request = $request->except("password","password_confirmation", "permissions");
        $new_request["password"] = Hash::make($request->password);

        $user = User::create($new_request);
        $user->attachRole("admin");
        $user->syncPermissions($request->permissions);
        $user["permission"] = $request->permissions;

        event("user.create",[$user,$request->password]);

        return redirect()->route("users.index")->with("success", "User created with successfuly");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("dashboard.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(User::rules($user->id));

        $request_without_permission = $request->except("password","password_confirmation", "permissions");
        
        $user->update($request_without_permission);
        $user->syncPermissions($request->permissions);

        return redirect()->route("users.index")->with("success", "User updated with successfuly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("users.index")->with("success", "User Deleted with successfuly");

    }
}
