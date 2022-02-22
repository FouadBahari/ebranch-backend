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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

#####################users############################
Route::group(['namespace' => 'API\Auth'], function () {
    Route::post('signup-user', 'UserController@signup');
    Route::post('Edit-Profile', 'UserController@editprofile');
    Route::get('Data-Edit-User', 'UserController@dataedituser');
    Route::get('Add-to-cart/{product}', 'UserController@addtocart');
    Route::get('Remove-from-cart/{product}', 'UserController@removetocart');
    Route::get('All-in-cart', 'UserController@allincart');

    Route::get('charge-card/{code}', 'UserController@chargecard');
    Route::get('Order-charge-card', 'UserController@orderschargecard');

    #####################orders############################
    //
});


####################APIS#######################
Route::group(['namespace' => 'API'], function () {
    Route::get('services', 'ApiController@services');
    Route::get('allvendors', 'ApiController@allvendors');
    Route::get('searchvendors/{name}', 'ApiController@searchvendors');
    Route::get('vendors/{idservice}', 'ApiController@vendors');
    Route::get('categories/{vendor}', 'ApiController@categories');
    Route::get('offers/{vendor}', 'ApiController@offers');
    Route::get('bestselles/{vendor}', 'ApiController@bestselles');
    Route::get('products', 'ApiController@products');
    Route::get('products-vendor/{cat}', 'ApiController@productsvendor');

    Route::post('contact-us', 'ApiController@contactus');

    Route::get('sliders', 'ApiController@sliders');
    Route::get('reasons/{type}', 'ApiController@reasons');
    Route::post('logins', 'ApiController@logins');
    // Route::post('Forget-Password', 'ApiController@forgetpass');
    // Route::post('Verify-Forget-Password', 'ApiController@verifyforgetpass');
    // Route::post('Rest-Password', 'ApiController@restpass');

});
