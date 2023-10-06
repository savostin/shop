<?php

namespace App\Models;

use App\Models\CartItem;
use App\Models\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = ['user_id', 'status', 'items'];

    // Define the relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Define the relationship with CartItem model
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    public function getAmountAttribute()
    {
        return $this->items->reduce(function ($sum, $item) {
            return $sum + $item->amount;
        }, 0);
    }
    public function getAmountStringAttribute()
    {
        return sprintf('%0.2f', $this->amount);
    }

}
