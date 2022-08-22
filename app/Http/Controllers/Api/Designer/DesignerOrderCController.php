<?php

namespace App\Http\Controllers\Api\Designer;

use App\Extra;
use App\Extra_order;
use App\Fabric;
use App\Fabric_order;
use App\Http\Controllers\Controller;
use App\Order;
use App\Order_detail;
use Illuminate\Http\Request;
use auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DesignerOrderCController extends Controller
{
    public function myOrders()
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $my_orders = Order::where('designer_id', auth::user()->id)->get();
        $pending_order = [];
        $compeleted_order = [];
        foreach ($my_orders as $order) {
            $order_details = Order_detail::where('order_id', $order->id)->get()->first();
            if ($order_details->design_image1 == null || $order_details->design_image2 == null) {
                $pending_order[] = $order;
            } else {
                $compeleted_order[] = $order;
            }
        }
        return response(['pending_order' => $pending_order, 'compeleted_order' => $compeleted_order]);
    }

    public function orderDetailsDesigner($id)
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $my_order = Order::find($id);
        $order_details = Order_detail::where('order_id', $id)->get()->first();
        $fabric_orders = Fabric_order::where('order_id', $id)->get();
        foreach ($fabric_orders as $fabric) {
            $fabric['fabric_details'] = Fabric::find($fabric->fabric_id);
        }

        $extra_orders = Extra_order::where('order_id', $id)->get();
        foreach ($extra_orders as $extra) {
            $extra['extra_details'] = Extra::find($extra->extra_id);
        }
        return response(['order' => $my_order, 'order_details' => $order_details, 'fabric_order' => $fabric_orders, 'extra_order' => $extra_orders]);
    }

    public function addDesignOrder(Request $request)
    {
        if (Auth() && Auth::user()->role_id != 2) {
            return response('unauthorized', 401);
        }
        $input = $request->all();
        $rules = array(
            'order_id' => 'required',
            'design_image1' => 'required',
            'design_image2' => 'required',

        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            $order = Order::find($request->order_id);
            $order_details = Order_detail::where('order_id', $request->order_id)->get()->first();
            if ($order_details->design_image1 == null || $order_details->design_image2 == null) {


                $image1 = $request->file('design_image1');
                $imageName1 = time() . $image1->getClientOriginalName();
                $filePath1 = 'images/order_design' . '/' . $imageName1;
                Storage::disk('s3')->put($filePath1, file_get_contents($image1));
                $order_details->design_image1 = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath1;

                $image2 = $request->file('design_image2');
                $imageName2 = time() . $image2->getClientOriginalName();
                $filePath2 = 'images/order_design' . '/' . $imageName2;
                Storage::disk('s3')->put($filePath2, file_get_contents($image2));
                $order_details->design_image2 = "https://lynfashion.s3.ap-south-1.amazonaws.com/" . $filePath2;

                $order_details->update();
                return response(['order' => $order, 'order_details' => $order_details, 'msg' => 'Image Uploaded .'], 200);
            } else {
                return response(['msg' => 'Image Already Uploaded .'], 402);
            }
        }
    }
}
