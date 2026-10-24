<?php
namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Cart::instance('cart')
            ->add(
                $request->product_id,
                $request->name,
                $request->quantity,
                $request->price
            )
            ->associate('App\Models\Product');

        return back()->with('success', 'Product added to cart successfully!');
    }

    public function index()
    {
        return view('cart.index');
    }

    public function update_cart(Request $request)
    {
        $request->validate([
            'rowId' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        Cart::instance('cart')->update(
            $request->rowId,
            $request->quantity
        );

        $this->calculateDiscount();

        return back()->with('success', 'Cart updated successfully!');
    }

    public function remove_from_cart(string $rowId)
    {
        Cart::instance('cart')->remove($rowId);

        $this->calculateDiscount();

        return back()->with('success', 'Product removed from cart successfully!');
    }

    public function clear_cart()
    {
        Cart::instance('cart')->destroy();
        Session::forget(['coupon', 'discount']);

        return back()->with('success', 'Cart cleared successfully!');
    }

    public function apply_coupon_code(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $couponCode = trim($request->coupon_code);

        $coupon = Coupon::where('code', $couponCode)
            ->whereDate('expiry_date', '>=', Carbon::today())
            ->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid or expired coupon code.');
        }

        $cartSubtotal = (float) Cart::instance('cart')->subtotal();

        if ($cartSubtotal < (float) $coupon->cart_value) {
            return back()->with(
                'error',
                'Your cart does not meet the minimum value for this coupon.'
            );
        }

        Session::put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => (float) $coupon->value,
            'cart_value' => (float) $coupon->cart_value,
        ]);

        $this->calculateDiscount();

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function calculateDiscount()
    {
        if (!Session::has('coupon')) {
            Session::forget('discount');
            return;
        }

        $coupon = Session::get('coupon');
        $cartSubtotal = (float) Cart::instance('cart')->subtotal();

        // Remove the coupon if the cart no longer meets its minimum value.
        if ($cartSubtotal < (float) $coupon['cart_value']) {
            Session::forget(['coupon', 'discount']);
            return;
        }

        if ($coupon['type'] === 'fixed') {
            $discount = (float) $coupon['value'];
        } else {
            $discount = ($cartSubtotal * (float) $coupon['value']) / 100;
        }

        // A discount cannot exceed the cart subtotal.
        $discount = min($discount, $cartSubtotal);

        $subtotalAfterDiscount = max(0, $cartSubtotal - $discount);

        Session::put('discount', [
            'discount' => number_format($discount, 2, '.', ''),
            'subtotal' => number_format($subtotalAfterDiscount, 2, '.', ''),
            'total' => number_format($subtotalAfterDiscount, 2, '.', ''),
        ]);
    }
}