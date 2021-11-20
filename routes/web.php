<?php

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

use Illuminate\Support\Facades\Route;

// use Illuminate\Routing\Route;

Route::get('/', 'HomeController@index');
Route::get('/products', 'ProductController@index');
Route::get('/product/{slug}', 'ProductController@show');

Route::get('/carts', 'CartController@index');
Route::get('/carts/remove/{cartID}', 'CartController@destroy');
Route::post('/carts', 'CartController@store');
Route::post('/carts/update', 'CartController@update');

Route::get('orders/checkout', 'OrderController@checkout');
Route::post('orders/checkout', 'OrderController@doCheckout');

Route::post('orders/shipping-cost', 'OrderController@shippingCost');
Route::post('orders/set-shipping', 'OrderController@setShipping');
Route::get('orders/received/{orderID}', 'OrderController@received');

Route::get('orders/cities', 'OrderController@cities');
Route::get('orders', 'OrderController@index');
Route::get('orders/{orderID}', 'OrderController@show');

Route::post('payments/notification', 'PaymentController@notification');
Route::get('payments/completed', 'PaymentController@completed');
Route::get('payments/failed', 'PaymentController@failed');
Route::get('payments/unfinish', 'PaymentController@unfinish');

Route::resource('favorites', 'FavoriteController');

Route::get('profile', 'Auth\ProfileController@index');
Route::post('profile', 'Auth\ProfileController@update');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(
    ['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']],
    function () {
        Route::get('dashboard', 'DashboardController@index');
        Route::resource('categories', 'CategoryController');

        Route::resource('products', 'ProductController');
        Route::get('products/{productID}/images', 'ProductController@images')->name('products.images');
        Route::get('products/{productID}/add-image', 'ProductController@add_image')->name('products.add_image');
        Route::post('products/images/{productID}', 'ProductController@upload_image')->name('products.upload_image');
        Route::delete('products/images/{imageID}', 'ProductController@remove_image')->name('products.remove_image');

        Route::resource('roles', 'RoleController');
        Route::resource('users', 'UserController');
        Route::post('users/{userID}', 'UserController@upload_image')->name('users.upload_image');

        Route::resource('profile', 'ProfileController');

 

        Route::resource('orders', 'OrderController');
        Route::get('orders/{orderID}/cancel', 'OrderController@cancel');
        Route::put('orders/cancel/{orderID}', 'OrderController@doCancel');
        Route::post('orders/complete/{orderID}', 'OrderController@doComplete');
     

        Route::resource('shipments', 'ShipmentController');

        Route::resource('slides', 'SlideImageController');
        Route::get('slides/{slideID}/up', 'SlideImageController@moveUp');
        Route::get('slides/{slideID}/down', 'SlideImageController@moveDown');

        Route::get('reports/product', 'ReportController@product');
        Route::get('reports/inventory', 'ReportController@inventory');
        Route::get('reports/payment', 'ReportController@payment');
        Route::get('reports/customer', 'ReportController@customer');
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
