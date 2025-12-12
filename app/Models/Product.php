<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'stock',
        'price',
        'unit',
        'image_path',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

}
