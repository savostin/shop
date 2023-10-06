<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Variation;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['qty', 'order_id', 'product', 'size', 'colour', 'price'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function getAmountAttribute()
    {
        return $this->qty * $this->price;
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
