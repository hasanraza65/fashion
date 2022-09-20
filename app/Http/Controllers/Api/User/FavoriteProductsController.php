<?php

namespace App\Http\Controllers\Api\User;
use App\Http\Controllers\Controller;
use auth;
use App\FavoriteProduct;

use Illuminate\Http\Request;

class FavoriteProductsController extends Controller
{
    public function index()
    {
        if (!Auth()) {
            return response('unauthorized', 401);
        }

        $favorites = FavoriteProduct::where('user_id', auth::user()->id)
        ->get();
       
        return response(['my_favorites' => $favorites]);
    }

    public function store(Request $request){

        if (!Auth()) {
            return response('unauthorized', 401);
        }

        $favorite_item = new FavoriteProduct;
        $favorite_item->product_id = $request->product_id;
        $favorite_item->user_id = Auth::user()->id;
        $favorite_item->save();

        $favorite_items = FavoriteProduct::all();

        return response(['my_favorite_items' => $favorite_items,'msg' => "Item added to your favorite list."]);

    }

    public function destroy($id){

        if (!Auth()) {
            return response('unauthorized', 401);
        }

        $favorite_item = FavoriteProduct::find($id);
        $favorite_item->delete();

        $favorite_items = FavoriteProduct::all();

        return response(['my_favorite_items' => $favorite_items,'msg' => "Item removed from your favorite list."]);

    }

    public function checkFavorite(Request $request){

        $favorite_item = FavoriteProduct::where('user_id', Auth::user()->id)
        ->where('product_id', $request->product_id)
        ->get();

        if(count($favorite_item) > 0){
            $msg = "Found";
        }else{
            $msg = "Not Found";
        }

        return response(['favorite_item'=>$favorite_item, 'msg' => $msg, 'productid' => $request->product_id]);

    }
}
