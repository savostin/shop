<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderUpdateRequest;
use App\Models\Enums\OrderStatusEnum;
use App\Models\Order;
use ErrorException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{

    public function view(Request $request, string $id): View
    {
        $order = Order::with('items')->find($id);
        if (!$order) {
            throw new NotFoundHttpException('Order not found');
        }
        return view('order.view', ['order' => $order]);
    }

    public function viewUserAll(Request $request): View
    {
        $orders = Order::with('items')->orderBy('created_at', 'asc')->get();
        return view('order.user', ['orders' => $orders]);
    }

    public function update(OrderUpdateRequest $request, string $id): RedirectResponse
    {
        $order = Order::find(['id' => $id, 'status' => OrderStatusEnum::UNPAID])->first();
        if (!$order) {
            throw new NotFoundHttpException('Order not found or paid already');
        }
        $data = $request->validated();
        $order->update(['shipment' => $data['shipment']]);
        return redirect()->route('external', ['id' => $order->id]);
    }

    public function paid(string $id): RedirectResponse
    {
        $order = Order::find(['id' => $id, 'status' => OrderStatusEnum::UNPAID])->first();
        if (!$order) {
            throw new NotFoundHttpException('Order not found or paid already');
        }
        if ($order->update(['status' => OrderStatusEnum::PAID])) {
            return redirect()->route('order.view', ['id' => $order->id]);
        }
        throw new ErrorException('Unable to update order');
    }

    public function external(string $id): View
    {
        $order = Order::find(['id' => $id, 'status' => OrderStatusEnum::UNPAID])->first();
        return view('order.external', ['amount' => $order->amount, 'id' => $order->id]);
    }

}
