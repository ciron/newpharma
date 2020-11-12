<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\Routing\RouterInterface;

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
Route::get('/','FrontendController@index')->name('user.dashbord');

Auth::routes();

Route::get('admin/home', 'AdminController@index');
Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin','Admin\LoginController@Login');
Route::get('admin/logout','AdminController@logout')->name('admin.logout');

//******************************Category*********************
Route::get('admin/category','admin\CategoryController@index')->name('admin.category');
Route::post('admin/category-store','admin\CategoryController@store')->name('store.category');
Route::get('admin/category/edit/{id}','admin\CategoryController@edit');
Route::post('admin/category-update','admin\CategoryController@update')->name('update.category');
Route::get('admin/category/delete/{id}','admin\CategoryController@destroy');
Route::get('admin/category/inactive/{id}','admin\CategoryController@inactive');
Route::get('admin/category/active/{id}','admin\CategoryController@active');

//******************************Brand************************ */
Route::get('admin/brand','Admin\BrandController@index')->name('admin.brand');
Route::post('admin/brand-store','admin\BrandController@store')->name('store.brand');
Route::get('admin/brand/edit/{id}','admin\BrandController@edit');
Route::post('admin/brand-update','admin\BrandController@update')->name('update.brand');
Route::get('admin/brand/delete/{id}','admin\BrandController@destroy');
Route::get('admin/brand/inactive/{id}','admin\BrandController@inactive');
Route::get('admin/brand/active/{id}','admin\BrandController@active');

// **************************order of admin******************
Route::get('admin/order/all','admin\OrderController@index')->name('order.index');
Route::get('admin/order/pending','admin\OrderController@indexpending')->name('order.pending');
Route::put('admin/order/{id}','admin\OrderController@aprove')->name('shift.order');


//*******************************Product********************* */
Route::get('admin/product/add','Admin\ProductController@addproduct')->name('admin.addproduct');
Route::post('admin/product/store','admin\ProductController@store')->name('store.product');
Route::get('admin/product/show','admin\ProductController@show')->name('show.product');
Route::get('admin/product/edit/{id}','admin\ProductController@edit');
Route::post('admin/product/update','admin\ProductController@update')->name('update.product');
Route::get('admin/product/delete/{id}','admin\ProductController@destroy');
Route::get('admin/product/inactive/{id}','admin\ProductController@inactive');
Route::post('admin/product/update/image','admin\ProductController@updateimage')->name('update.image');
Route::get('admin/product/active/{id}','admin\ProductController@active');
//******************************Coupon*********************
Route::get('admin/coupon','admin\CouponController@index')->name('admin.coupon');
Route::post('admin/coupon-store','admin\CouponController@store')->name('store.coupon');
Route::get('admin/coupon/edit/{id}','admin\CouponController@edit');
Route::post('admin/coupon-update','admin\CouponController@update')->name('update.coupon');
Route::get('admin/coupon/delete/{id}','admin\CouponController@destroy');
Route::get('admin/coupon/inactive/{id}','admin\CouponController@inactive');
Route::get('admin/coupon/active/{id}','admin\CouponController@active');

//*************************************************preview******************
Route::get('product/details/{id}','FrontendController@details')->name('product.details');
Route::post('product/added/{id}','FrontendController@store')->name('product.cart');

Route::get('review/add/{id}','FrontendController@storing')->name('review.add');
// Route::get('review/add/{id}','FrontendController@review')->name('review.add');
// Route::get('/rating','ReviewController@create');



//  ************************wishlist*************************
Route::get('wishlist/add/{product_id}','frontend\WishlistController@create')->name('wishlist.create');
Route::get('wishlist/all','frontend\WishlistController@index')->name('wish.index');
Route::get('wish/destroy/{id}','frontend\WishlistController@destroy')->name('wishlist.delete');

Route::get('checkout','OrderController@index')->name('checkout.index');
Route::get('order/details','OrderController@show')->name('order.product');
Route::get('checkout/create','OrderController@store')->name('checkout.ad');

//***************************cart*******************************************
Route::post('Cart/coupon','frontend\CartController@aplycoupon')->name('aplycupon');
Route::resource('Cart', 'frontend\CartController');



