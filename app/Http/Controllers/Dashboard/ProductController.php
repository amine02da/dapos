<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if($name = $request->query("name"))
        {
            $query->where("name", "like", "%{$name}%");
        }

        if($category_id = $request->query("category_id"))
        {
            $query->where("category_id", "=", $category_id);
        }

        $products = $query->paginate(4);
        return view("dashboard.products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::Active()->get();
        return view("dashboard.products.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Product::rules());

        $request_without_image = $request->except("image");

        if($request->hasFile("image"))
        {
            $file = $request->image;
            $path = $file->store("uploads", "public");
            $request_without_image["image"] = $path;
        }

        Product::create($request_without_image);
        return redirect()->route("products.index")->with("success", "Product has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view("dashboard.products.edit", compact("product" ,"categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate(Product::rules());

        $old_image = $product->image;
        $request_without_image = $request->except("image");

        if($request->hasFile("image"))
        {
            $file = $request->image;
            $path = $file->store("uploads", "public");
            $request_without_image["image"] = $path;
        }

        $product->update($request_without_image);

        if($old_image &&  isset($request_without_image["image"]) && $product->image != "uploads/default.png"){
            Storage::disk("public")->delete($old_image);
        }

        return redirect()->route("products.index")->with("success", "Product has been updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        if($product->image && $product->image != "uploads/default.png"){
            Storage::disk("public")->delete($product->image);
        }
        return redirect()->route("products.index")->with("success", "Product has been deleted");
    }
}
