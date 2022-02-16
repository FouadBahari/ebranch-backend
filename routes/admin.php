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

    ######################### Begin coupons Routes ########################Done
    Route::group(['prefix' => 'coupons'], function () {
        Route::get('/','CouponsController@index') -> name('admin.coupons');
        Route::get('create','CouponsController@create') -> name('admin.coupons.create');
        Route::post('store','CouponsController@store') -> name('admin.coupons.store');
        Route::get('edit/{id}','CouponsController@edit') -> name('admin.coupons.edit');
        Route::post('update/{id}','CouponsController@update') -> name('admin.coupons.update');
        //Route::get('delete/{id}','CouponsController@destroy') -> name('admin.coupons.delete');
    });
    ######################### End coupons Routes  ########################

    ######################### Begin users Routes ########################Done
    Route::group(['prefix' => 'users'], function () {
    Route::get('/','UserController@index') -> name('admin.users');
    Route::get('create','UserController@create') -> name('admin.users.create');
    Route::post('store','UserController@store') -> name('admin.users.store');
    Route::get('edit/{id}','UserController@edit') -> name('admin.users.edit');
    Route::post('update/{id}','UserController@update') -> name('admin.users.update');
    //Route::get('delete/{id}','UserController@destroy') -> name('admin.users.delete');
});
######################### End users Routes  #######################


});

Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'loginController@getLogin')->name('admin.login');
    Route::post('login', 'loginController@login')->name('admin.login');
});

//});

