<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index(){
        return view('cart.checkout');
    }
    public function OrderStore(Request $request){

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'number' => ['required', 'string', 'max:20'],
        'wilaya' => ['required', 'string', 'max:255'],
        'commune' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:1000'],
    ]);
    $cart = Cart::instance('cart');
    $items = $cart->content();

    if ($items->isEmpty()) {
        return redirect()->route('shop.index')
            ->with('error', 'Your cart is empty.');
    }

    $subtotal= (float) $items->sum('subtotal');
    $discount= (float) session('discount.discount',0);
    $discount = min(max(0,$discount),$subtotal);
    $total = $subtotal - $discount ;

     DB::transaction(function () use (
        $validated,
        $subtotal,
        $discount,
        $total,
        $items
    ) {
        $order = Order::create([
            'name' => $validated['name'],
            'number' => $validated['number'],
            'wilaya' => $validated['wilaya'],
            'commune' => $validated['commune'],
            'address' => $validated['address'],
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            $order->items()->create([
                'product_id' => $item->id,
                'product_name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->qty,
                'subtotal' => $item->subtotal,
            ]);
        }
    });

    // Clear the cart and coupon only after the transaction succeeds.
    Cart::instance('cart')->destroy();
    session()->forget(['coupon', 'discount']);

    return redirect()->route('shop.index')
        ->with('success', 'Your order has been placed successfully!');




    }
}
