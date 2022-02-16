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
    /*******************Authintication View***********************/
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/update-profile', 'HomeController@updateprofile')->name('post.profile');

  
//});


