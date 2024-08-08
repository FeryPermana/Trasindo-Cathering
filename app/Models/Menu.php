<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id', 'name', 'description', 'photo', 'price',
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function formattedPrice()
    {
        return number_format($this->price, 2, ',', '.');
    }
}
