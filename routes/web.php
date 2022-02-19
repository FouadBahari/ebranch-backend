<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Service;

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
/*
Route::group( [ 'prefix' => 'LaravelLocalization'::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] ],function(){ *///start translate
    /*******************UnAuthintication View***********************/
    Route::get('/', function () {

        return view('welcome');
    });


    Route::get('/Services/{type}', function ($type) {
        $service       = Service::where('name',$type)->first();
        if($service){
            return view('service',compact('service'));
        }else{
            notify()->info('الذي تبحث عنة غير متاح');
            return redirect(url('/'));
        }
    })->name('services');

    Route::post('/send-message', 'Controller@sendmessage')->name('send.message');
    Route::post('/Add-Newsletter', 'Controller@addnews')->name('add.news');
    Route::post('/devicetoken-guest', 'Controller@devicetokenguest')->name('save.token.guest');


    Auth::routes();
    /*******************Authintication profile***********************/
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/update-profile', 'HomeController@updateprofile')->name('post.profile');
    /*******************Vendor Page***********************/
    Route::group(['prefix' => 'cats'], function () {
        Route::get('/','CatController@index') -> name('vendor.cats');
        Route::get('create/','CatController@create') -> name('vendor.cats.create');
        Route::post('store','CatController@store') -> name('vendor.cats.store');
        Route::get('edit/{id}','CatController@edit') -> name('vendor.cats.edit');
        Route::post('update/{id}','CatController@update') -> name('vendor.cats.update');
        //Route::get('delete/{id}','CatController@destroy') -> name('vendor.cats.delete');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/','ProductController@index') -> name('vendor.products');
        Route::get('create/','ProductController@create') -> name('vendor.products.create');
        Route::post('store','ProductController@store') -> name('vendor.products.store');
        Route::get('edit/{id}','ProductController@edit') -> name('vendor.products.edit');
        Route::post('update/{id}','ProductController@update') -> name('vendor.products.update');
        //Route::get('delete/{id}','ProductController@destroy') -> name('vendor.products.delete');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/','OrderController@index') -> name('vendor.orders');
    });
//});


