<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'address', 'city',
        'postal_code', 'total', 'shipping_method', 'payment_method', 'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}