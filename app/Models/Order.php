<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function driver()
    {
        return $this->belongsTo('App\User','driver_id','id');
    }
}
