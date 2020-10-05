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
Route::get('/','FrontendController@index');

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
//*******************************Product********************* */
Route::get('admin/product/add','Admin\ProductController@addproduct')->name('admin.addproduct');
Route::post('admin/product/store','admin\ProductController@store')->name('store.product');
Route::get('admin/product/show','admin\ProductController@show')->name('show.product');

Route::get('admin/product/delete/{id}','admin\ProductController@destroy');
Route::get('admin/product/inactive/{id}','admin\ProductController@inactive');
Route::get('admin/product/active/{id}','admin\ProductController@active');

