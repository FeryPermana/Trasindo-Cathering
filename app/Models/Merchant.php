<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'company_name', 'address', 'contact', 'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderItem::class, 'menu_id', 'id', 'id', 'order_id')
                    ->join('menus', 'order_items.menu_id', '=', 'menus.id')
                    ->where('menus.merchant_id', $this->id);
    }
}
