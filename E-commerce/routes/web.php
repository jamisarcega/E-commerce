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

Route::get('/','GuestController@index')->name('landing');
Route::get('/view-product/{product}','GuestController@viewProduct')->name('viewProduct');
Route::get('/about-us','GuestController@aboutUs')->name('aboutUs');
Route::get('/contact', function(){
    return view('contact');
})->name('contactUs');
Route::get('/find/products/','GuestController@findProducts')->name('findProducts');
//stores
Route::get('/store/login', 'Auth\StoreLoginController@storeLogin')->name('store.login');
Route::post('/store/login', 'Auth\StoreLoginController@storeLoginSubmit')->name('store.loginSubmit');
Route::post('/store/logout', 'Auth\LoginController@logoutStore')->name('store.logout');
Route::get('/store/dashboard', 'StoreController@index')->name('store.index');
Route::get('/store/products', 'StoreController@products')->name('store.products');
Route::get('/store/orders', 'StoreController@getOrders')->name('store.orders');
Route::post('/store/orders/{order}/tracking', 'StoreController@updateOrder')->name('store.tracking');
Route::post('/store/add/products', 'StoreController@addProduct')->name('store.addProduct');
Route::post('/store/edit/product\{product}', 'StoreController@editProduct')->name('store.editProduct');
Route::get('/store/store/products/find/{id}', 'StoreController@findProduct')->name('store.findProduct');
Route::get('/store/store/products/filter', 'StoreController@filterProducts')->name('store.filterProducts');
Route::get('/store/account-settings', 'StoreController@accountSettings')->name('store.accountSettings');
Route::patch('/store/update-password/{store}', 'StoreController@updatePassword')->name('store.updatePassword');
Route::patch('/store/update-name/{store}', 'StoreController@updateName')->name('store.updateName');
Route::post('/store/update-photo/{store}', 'StoreController@updatePhoto')->name('store.updatePhoto');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('user.home');
Route::get('/user/wishlist', 'HomeController@getWishlist')->name('user.getWishlist');
Route::delete('/user/remove-wishlist/{product}', 'HomeController@removeWishlist')->name('user.removeWishlist');
Route::post('/cart/add/{product}', 'HomeController@addToCart')->name('user.addToCart');
Route::delete('/cart/remove/{order}', 'HomeController@deleteFromCart')->name('user.deleteFromCart');
Route::get('/cart/checkout/', 'HomeController@checkout')->name('user.checkout');
Route::get('/cart/checkout/billing', 'HomeController@charge')->name('user.charge');
Route::post('/cart/checkout/billing', 'HomeController@billing')->name('user.billing');
Route::get('/purchase-history', 'HomeController@history')->name('user.history');
Route::get('/purchase-history/notification/{order}', 'HomeController@getNotification')->name('user.notificationUpdate');
Route::post('/wishlist/add/{product}', 'HomeController@addToWishlist')->name('user.addToWishlist');
Route::get('/account-settings', 'HomeController@accountSettings')->name('user.account');
Route::patch('/update-password/{user}', 'HomeController@updatePassword')->name('user.updatePassword');
Route::patch('/update-name/{user}', 'HomeController@updateName')->name('user.updateName');
Route::post('/update-photo/{user}', 'HomeController@updatePhoto')->name('user.updatePhoto');
Route::post('/product/rate', 'HomeController@rate')->name('user.rate');


Route::post('/register/user', 'GuestController@registerUser')->name('user.newUser');
Route::post('/register/store', 'GuestController@registerStore')->name('store.newUser');


Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/terms-of-service', 'AdminController@terms')->name('admin.terms');
Route::post('/admin/terms-of-service', 'AdminController@updateTerms')->name('admin.updateTerms');
Route::get('/admin/manage/accounts', 'AdminController@manageAccounts')->name('admin.accounts');
Route::post('/admin/enable/user/{user}', 'AdminController@enableUser')->name('enable.user');
Route::post('/admin/disable/user/{user}', 'AdminController@disableUser')->name('disable.user');
Route::post('/admin/enable/store/{store}', 'AdminController@enableStore')->name('enable.store');
Route::post('/admin/disable/store/{store}', 'AdminController@disableStore')->name('disable.store');
Route::get('/admin/login', 'Auth\AdminLoginController@adminLogin')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@adminLoginSubmit')->name('admin.loginSubmit');
Route::get('/admin/account-settings', 'AdminController@accountSettings')->name('admin.account');
Route::patch('/admin/update-password/{admin}', 'AdminController@updatePassword')->name('admin.updatePassword');
Route::post('/admin/update-photo/{admin}', 'AdminController@updatePhoto')->name('admin.updatePhoto');
Route::get('/admin/receivables', 'AdminController@receivables')->name('admin.receivables');

