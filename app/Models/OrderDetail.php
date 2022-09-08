<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $guarded = [];

    protected function user(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->belong(user::class, 'user_id' , 'id');
    }

}
