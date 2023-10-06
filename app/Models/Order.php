<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Enums\CartStatusEnum;
use App\Models\OrderItem;
use App\Models\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Uuids;
    use HasFactory;
    protected $fillable = ['user_id', 'status', 'items', 'amount', 'shipment'] ;

    public static function createFromCart(Cart $cart): Order
    {
        if (!$cart->user) {
            throw new \InvalidArgumentException('Cart must be owned');
        }
        $order = Order::create(['user_id' => $cart->user->id, 'amount' => $cart->amount]);
        foreach ($cart->items as $item) {
            $oitem = OrderItem::create([
                'order_id' => $order->id,
                'product' => $item->variation->product->name,
                'size' => $item->variation->size,
                'colour' => $item->variation->colour,
                'price' => $item->variation->price,
                'qty' => $item->qty]);
        }
        $order->save();
        $cart->update(['status' => CartStatusEnum::PURCHASED]);
        return $order;
    }

    // Define the relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Define the relationship with CartItem model
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getAmountStringAttribute()
    {
        return sprintf('%0.2f', $this->amount);
    }

}
