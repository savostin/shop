<?php

namespace App\Models;

use App\Models\Variation;
use App\Model§s\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = ['qty', 'cart_id', 'variation_id'];
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function getAmountAttribute()
    {
        return $this->qty * $this->variation->price;
    }
    public function getAmountStringAttribute()
    {
        return sprintf('%0.2f', $this->amount);
    }
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

}
