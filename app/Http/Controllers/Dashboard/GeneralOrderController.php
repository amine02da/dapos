<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class GeneralOrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(5);
        return view("dashboard.generalOrdes.index", compact("orders"));
    }

    public function products($id)
    {
        $order = Order::findOrFail($id);
        
        $products = $order->Products;
        
        return view("dashboard.generalOrdes._product", compact("order", "products"));
        
    }
    
    public function changerStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            "status" => $request->status
        ]);
        
        return redirect()->route("orders.index")->with("success", "Status has been changed");
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route("orders.index")->with("success", "Order has been deleted");
    }
}
