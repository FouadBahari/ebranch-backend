<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCard extends Model
{
    protected $table = 'order-cards';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function card()
    {
        return $this->belongsTo('App\Models\Card','card_id','id');
    }
}
