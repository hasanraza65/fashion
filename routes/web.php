<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::resource('/admin', 'Admin\AdminController');
Route::resource('/banner', 'Admin\BannerController');
Route::resource('/designer', 'Admin\DesignerController');
Route::resource('/manufacturer', 'Admin\ManufracturerController');
Route::resource('/fabric', 'Admin\FabricController');
Route::resource('/order', 'Admin\OrderController');
Route::resource('/transaction', 'Admin\TransactionController');
Route::resource('/member_transaction', 'Admin\MemberTransactionController');
Route::resource('/cat', 'Admin\CatlogCategoryController');
Route::resource('/extra', 'Admin\ExtraController');
Route::resource('/manufacturing_cost', 'Admin\ManufacturingCostController');
Route::resource('/order_compelete', 'Admin\OrderCompeleteController');
Route::resource('/productcategories', 'Admin\ProductCategoryController');


//new routes admin
Route::resource('/product_categories', 'Admin\ProductCategoryController');

//Products Admin Routes (Hassan Raza)
Route::resource('/products', 'Admin\ListProductController');





Route::resource('/manufacturer-web', 'Manufacturer\ManufacturerWebController');
Route::resource('/order-manufacturer', 'Manufacturer\ManufacturerOrderController');
Route::get('/manufacturer-view/{id}', 'Manufacturer\ManufacturerOrderController@view')->name('manufacturer-view');
Route::resource('/manufacturer-transaction', 'Manufacturer\ManufacturerTansactionController');




// Route::resource('/doner', 'Admin\DonerController');
// Route::resource('/request', 'Admin\RequestListController');
// Route::resource('/feedback', 'Admin\FeedbackController');
Route::get('change-password', 'ChangePasswordController@index')->name('change.password');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
// Route::get('findMatch/{reciver_id}', 'Admin\DonerController@findMatch')->name("doner.findMatch");
// Route::resource('/reciver', 'Admin\ReciverController');
