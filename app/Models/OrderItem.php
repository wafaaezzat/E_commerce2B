<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $guarded = [];


    protected function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id' , 'id');
    }

}
