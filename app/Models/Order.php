<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_code',
        'receiver_name',
        'receiver_phone',
        'shipping_address',
        'subtotal',
        'shipping_cost',
        'shipping_method',
        'total',
        'status',
        'payment_method',
        'payment_status',
        'payment_proof_path',
        'shipped_at',
        'delivered_at',
        'verified_at',
    ];

    protected $casts = [
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
