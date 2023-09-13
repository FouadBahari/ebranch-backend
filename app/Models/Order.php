<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    protected $fillable = [
        'product_id', 'amount','username','userphone','vendor_id',
        'vendor_phone','vendor_name','vendor_address','vendor_lat','vendor_lang','price','user_id','address','status','lat','lang','type','color','size','shipping_price','driver_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function driver()
    {
        return $this->belongsTo('App\User','driver_id','id');
    }
}
