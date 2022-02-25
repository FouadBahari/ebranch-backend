<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

define('PAGINATION_COUNT',10);
/*Route::group( [ 'prefix' => 'LaravelLocalization'::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] ],function(){ */

Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
    Route::post('/Send-Messages', 'DashboardController@sendmessages')->name('admin.send.messages');
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/Editprofile', 'DashboardController@editprofile')->name('admin.editprofile');
    Route::post('/updateprofile/{id}', 'DashboardController@updateprofile')->name('admin.updateprofile');
    Route::post('/logout', 'DashboardController@logout')->name('admin.logout');
    Route::get('/products', 'DashboardController@products')->name('admin.products');
    //////////////////settings//////////////////
    Route::get('/settings', 'DashboardController@settings')->name('admin.settings');
    Route::post('/update-settings', 'DashboardController@updatesettings')->name('admin.settings.update');

######################### Begin services Routes ########################Done
Route::group(['prefix' => 'chargers'], function () {
    Route::get('/','DashboardController@chargers') -> name('admin.chargers');
    Route::get('create','DashboardController@createchargers') -> name('admin.chargers.create');
    Route::post('store','DashboardController@storechargers') -> name('admin.chargers.store');
    Route::get('edit/{id}','DashboardController@editchargers') -> name('admin.chargers.edit');
    Route::post('update/{id}','DashboardController@updatechargers') -> name('admin.chargers.update');
    //Route::get('delete/{id}','DashboardController@destroychargers') -> name('admin.chargers.delete');
});
######################### End services Routes  ########################
    ######################### Begin services Routes ########################Done
    Route::group(['prefix' => 'services'], function () {
        Route::get('/','ServicesController@index') -> name('admin.services');
        Route::get('create','ServicesController@create') -> name('admin.services.create');
        Route::post('store','ServicesController@store') -> name('admin.services.store');
        Route::get('edit/{id}','ServicesController@edit') -> name('admin.services.edit');
        Route::post('update/{id}','ServicesController@update') -> name('admin.services.update');
        //Route::get('delete/{id}','ServicesController@destroy') -> name('admin.services.delete');
    });
    ######################### End services Routes  ########################

    ######################### Begin coupons Routes ########################
    Route::group(['prefix' => 'coupons'], function () {
        Route::get('/','CouponsController@index') -> name('admin.coupons');
        Route::get('create','CouponsController@create') -> name('admin.coupons.create');
        Route::post('store','CouponsController@store') -> name('admin.coupons.store');
        Route::get('edit/{id}','CouponsController@edit') -> name('admin.coupons.edit');
        Route::post('update/{id}','CouponsController@update') -> name('admin.coupons.update');
        //Route::get('delete/{id}','CouponsController@destroy') -> name('admin.coupons.delete');
    });
    ######################### End coupons Routes  ########################
    ######################### Begin counteries Routes ########################
    Route::group(['prefix' => 'counteries'], function () {
        Route::get('/','CounteryController@index') -> name('admin.counteries');
        Route::get('create','CounteryController@create') -> name('admin.counteries.create');
        Route::post('store','CounteryController@store') -> name('admin.counteries.store');
        Route::get('edit/{id}','CounteryController@edit') -> name('admin.counteries.edit');
        Route::post('update/{id}','CounteryController@update') -> name('admin.counteries.update');
        //Route::get('delete/{id}','CounteryController@destroy') -> name('admin.counteries.delete');
    });
    ######################### End counteries Routes  ########################

    ######################### Begin users Routes ########################Done
    Route::group(['prefix' => 'users'], function () {
    Route::get('/{type}','UserController@index') -> name('admin.users');
    Route::get('/driver/wait-approve','UserController@waitapprove') -> name('admin.users.waitapprove');
    Route::get('/approved/{id}','UserController@approved') -> name('admin.users.approved');
    Route::get('create/{type}','UserController@create') -> name('admin.users.create');
    Route::post('store','UserController@store') -> name('admin.users.store');
    Route::get('edit/{id}','UserController@edit') -> name('admin.users.edit');
    Route::post('update/{id}','UserController@update') -> name('admin.users.update');
    //Route::get('delete/{id}','UserController@destroy') -> name('admin.users.delete');
});
######################### End users Routes  #######################
######################### Begin cards Routes ########################
Route::group(['prefix' => 'cards'], function () {
    Route::get('/','CardController@index') -> name('admin.cards');
    Route::get('create','CardController@create') -> name('admin.cards.create');
    Route::post('store','CardController@store') -> name('admin.cards.store');
    Route::get('edit/{id}','CardController@edit') -> name('admin.cards.edit');
    Route::post('update/{id}','CardController@update') -> name('admin.cards.update');
    //Route::get('delete/{id}','CardController@destroy') -> name('admin.cards.delete');
});
######################### End cards Routes  ########################
######################### Begin banners Routes ########################
Route::group(['prefix' => 'banners'], function () {
    Route::get('/','BannerController@index') -> name('admin.banners');
    Route::get('create','BannerController@create') -> name('admin.banners.create');
    Route::post('store','BannerController@store') -> name('admin.banners.store');
    Route::get('edit/{id}','BannerController@edit') -> name('admin.banners.edit');
    Route::post('update/{id}','BannerController@update') -> name('admin.banners.update');
    //Route::get('delete/{id}','BannerController@destroy') -> name('admin.banners.delete');
});
######################### End banners Routes  ########################
######################### Begin reasons Routes ########################
Route::group(['prefix' => 'reasons'], function () {
    Route::get('/','ReasonController@index') -> name('admin.reasons');
    Route::get('create','ReasonController@create') -> name('admin.reasons.create');
    Route::post('store','ReasonController@store') -> name('admin.reasons.store');
    Route::get('edit/{id}','ReasonController@edit') -> name('admin.reasons.edit');
    Route::post('update/{id}','ReasonController@update') -> name('admin.reasons.update');
    //Route::get('delete/{id}','ReasonController@destroy') -> name('admin.reasons.delete');
});
######################### End reasons Routes  ########################
######################### Begin orders Routes ########################
Route::group(['prefix' => 'orders'], function () {
    Route::get('/{type}','OrderController@index')->name('admin.orders');
    Route::get('/status/{status}/{id}','OrderController@status')->name('admin.orders.status');
});
//طلبات شركة الشحن
######################### End orders Routes  ########################
});

Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'loginController@getLogin')->name('admin.login');
    Route::post('login', 'loginController@login')->name('admin.login');
});

//});

