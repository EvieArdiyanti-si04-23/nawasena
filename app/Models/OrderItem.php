<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'menu_id', 'quantity', 'price'];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
