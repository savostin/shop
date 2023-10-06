<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartAddRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Enums\CartStatusEnum;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    private function getCurrentCart(Request $request): Cart
    {
        $cart_id = $request->session()->get('cart');
        $cart = Cart::with('items.variation.product')->firstOrCreate(['id' => $cart_id, 'status' => CartStatusEnum::CREATED]);
        $request->session()->put('cart', $cart->id);
        return $cart;
    }

    public function view(Request $request): View
    {
        $cart = self::getCurrentCart($request);
        self::setUser($request);
        return view('cart.view', ['cart' => $cart]);
    }

    public function checkout(Request $request): RedirectResponse
    {
        self::setUser($request);
        $cart = self::getCurrentCart($request);
        $order = Order::createFromCart($cart);
        return redirect()->route('order.view', ['id' => $order->id]);
    }

    public function setUser(Request $request): bool
    {
        $cart = self::getCurrentCart($request);
        if (!$cart->user && $request->user()) {
            $cart->update(['user_id' => $request->user()->id]);
            $cart->save();
            return true;
        }
        return false;
    }

    public function add(CartAddRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $cart = self::getCurrentCart($request);
        $item = CartItem::where(['cart_id' => $cart->id, 'variation_id' => $data['variation']])->first();
        if ($item) {
            $item->update(['qty' => $item->qty + $data['qty']]);
        } else {
            CartItem::create(['cart_id' => $cart->id, 'variation_id' => $data['variation'], 'qty' => $data['qty']]);
        }
        return back()->with('status', 'item-added');
    }

}
