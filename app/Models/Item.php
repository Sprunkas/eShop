<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'position', 
        'item',
        'quantity',
        'price',
        'sum', 
    ];

    public function orders()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
