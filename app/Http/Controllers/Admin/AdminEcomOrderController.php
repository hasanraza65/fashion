<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Auth;
use File;
use App\Product;
use App\EcomOrders;
use App\EcomOrderItems;
use App\User;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AdminEcomOrderController extends Controller
{
    public function index(){

        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }

        $orders = EcomOrders::with('orderItems')
        ->get();

        $title = "Orders";

        return view('admin.ecomorders.list', compact(['orders', 'title']));
    }

    public function edit($id=null){

        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }

        $order = EcomOrders::find($id);
        $users = User::all();

        $title = "Edit Order";

        return view('admin.ecomorders.edit', compact(['order', 'title', 'users']));

    }

    public function update(Request $request, $id){

        if (Auth::user()->is_admin == 0) {
            return redirect(route('home'));
        }

        $request->validate([
            'buyer_id' => 'required'
        ]);

        $order = EcomOrders::find($id);
        $order->payment_status	= $request->payment_status;
        $order->delivery_status	= $request->delivery_status;
        $order->buyer_id	= $request->buyer_id;
        $order->update();

        session()->flash('success', ' Order Updated Successfully');
        return back();
    }

    public function manageOrderItemsView($id){

        $order_items = EcomOrderItems::where('ecom_order_id', $id)
        ->with('itemData')
        ->get();

        $title = "Order items";

        return view('admin.ecomorders.orderitems', compact(['order_items', 'title']));

    }

    public static function getItemName($itemid=null){

        $product = Product::find($itemid); 
        return $product->name;

    }

    public static function removeOrderItem($id=null){

        $orderproduct = EcomOrderItems::find($id); 

        $product = Product::find($orderproduct->product_id);
        $product->p_qty = $product->p_qty+$orderproduct->selected_qty;
        $product->update();
        
        $orderproduct->delete();

        session()->flash('success', ' Item Removed From The Order Successfully');
        return back();

    }

    public function destroy($id){

        $order = EcomOrders::find($id);

        $orderitems = EcomOrderItems::where('ecom_order_id',$id)->get(); 

        foreach($orderitems as $orderitemss){

           

            $product = Product::find($orderitemss->product_id);
            $product->p_qty = $product->p_qty+$orderitemss->selected_qty;
            $product->update();

            $currentitem = EcomOrderItems::find($orderitemss->id); 
            $currentitem->delete();

        }

        $order->delete();

        session()->flash('success', ' Order Deleted Successfully');
        return back();

    }
}
