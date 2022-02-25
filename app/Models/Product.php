<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function cat()
    {
        return $this->belongsTo('App\Models\Cat','cat_id','id');
    }

    public function client()
    {
        return $this->belongsToMany('App\User','carts');
    }
    
     public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset($val) : "";

    }

    /*many to many create record
    $user = User::find(2);
    $products = [1, 2];
    $user->products()->attach($products);  || $user->products()->sync($products);*/

    /*many to many remove record
    $user = User::find(2);
    $products = [1, 2];
    $user->products()->detach($products);  || $user->products()->sync($products);*/

    /*many to many select record
    $user = User::find(1);
    foreach ($user->products as $product) {
        echo $product->pivot->created_at;
    }
    */
}
