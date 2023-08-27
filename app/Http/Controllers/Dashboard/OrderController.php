<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("ok");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $client = Client::findOrFail($id);
        $orders = $client->Orders()->with("Products")->get();
        $categories = Category::Active()->with("products")->get();

        return view("dashboard.orders.create",compact("client", "orders", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            "products" => "required|array",
            "quantities" => "required|array",
        ]);

        $order = $client->Orders()->create([
            "total_price" => $request->total_price
        ]);

        foreach($request->products as $i => $product_id)
        {
            $product = Product::findOrFail($product_id);

            $order->Products()->attach($product_id, ["quantity" => $request->quantities[$i]]);

            $product->update([
                "quantity" => $product->quantity - $request->quantities[$i]
            ]);
        }
        return redirect()->route("orders.index")->with("success", "Order has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        dd($order);
        return view("dashboard.order.edit",compact("order"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
