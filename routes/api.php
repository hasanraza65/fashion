<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//all products listing for all users
Route::get('/products', 'AllProductsController@apiProducts');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('/changePassword', 'Api\AuthController@changePassword');
Route::post('/forgot_password', 'Api\AuthController@forgot_password');
// Route::apiResource('/reciver', 'Api\ReciverController')->middleware('auth:api');
// Route::apiResource('/cities', 'Api\CitiesController');
// Route::apiResource('/req', 'Api\RequestListController')->middleware('auth:api');;
// Route::apiResource('/feedback', 'Api\FeedbackController')->middleware('auth:api');;



//designer
Route::apiResource('/designer_home', 'Api\Designer\HomeController')->middleware('auth:api');
Route::apiResource('/designer_bank', 'Api\Designer\BankController')->middleware('auth:api');
Route::apiResource('/my_catlog', 'Api\Designer\CatlogController')->middleware('auth:api');
Route::get('/pre_order_data', 'Api\Designer\PreOrderController@preOrderData')->middleware('auth:api');
Route::get('/designer_transaction', 'Api\Designer\DesignerTransactionController@myTransaction')->middleware('auth:api');
Route::get('/designer_trim_details/{id}', 'Api\Designer\DesignerTrimDetailsController@trimsDetails')->middleware('auth:api');
Route::get('/designer_fabric_details/{id}', 'Api\Designer\DesignerFabricDetailsController@fabricsDetails')->middleware('auth:api');
Route::get('/designer_style_details/{id}', 'Api\Designer\DesignerManufacturingCostDetailsController@stylesDetails')->middleware('auth:api');
Route::get('/designer_orders', 'Api\Designer\DesignerOrderCController@myOrders')->middleware('auth:api');
Route::post('/designer_orders_update', 'Api\Designer\DesignerOrderCController@addDesignOrder')->middleware('auth:api');
Route::get('/designer_orders/{id}', 'Api\Designer\DesignerOrderCController@orderDetailsDesigner')->middleware('auth:api');

//new deisgner api
//deisgner products
Route::apiResource('/designer_products', 'Api\Designer\DesignerProductController')->middleware('auth:api');
Route::get('/products_by_designer/{id}', 'Api\Designer\DesignerProductController@designerProducts')->middleware('auth:api');

//new user api
//create new order by hassan 
Route::apiResource('/ecom_order', 'Api\User\EcomOrdersController')->middleware('auth:api');
Route::apiResource('/ecom_order_item', 'Api\User\EcomOrderItemsController')->middleware('auth:api');

/////product categories
Route::apiResource('/productcategories', 'Api\Designer\CategoriesController')->middleware('auth:api');


//user
Route::apiResource('/user_home', 'Api\User\UserHomeController')->middleware('auth:api');
Route::apiResource('/user_order', 'Api\User\UserOrderController')->middleware('auth:api');
Route::get('/user_trim_single/{id}', 'Api\User\UserTrimsController@get');
Route::get('/user_trims', 'Api\User\UserTrimsController@index');
Route::get('/user_fabric_single/{id}', 'Api\User\UserFabricsController@get');
Route::get('/user_fabrics', 'Api\User\UserFabricsController@index');
