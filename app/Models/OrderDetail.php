<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    public $guarded = [];

    protected function user()
    {
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }

    protected function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id' , 'id');
    }

}
