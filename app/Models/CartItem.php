<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'session_id', 'producto_nombre', 'producto_imagen',
        'producto_emoji', 'producto_bg', 'precio', 'cantidad',
    ];

    protected $casts = [
        'precio'   => 'float',
        'cantidad' => 'integer',
    ];

    public function getSubtotalAttribute(): float
    {
        return $this->precio * $this->cantidad;
    }

    public function scopeSession($query, string $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }
}