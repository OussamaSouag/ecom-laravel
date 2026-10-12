<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;


class CouponController extends Controller
{
    public function coupon()
    {
        $coupons = Coupon::orderBy('expiry_date', 'DESC')->paginate(12);
        return view('admin.coupons', compact('coupons'));
    }
    public function coupon_add()
    {
        $coupons = Coupon::orderBy('expiry_date', 'DESC')->paginate(12);
        return view('admin.coupon-add');
    }
    public function coupon_store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'cart_value' => 'required|numeric|min:0',
            'expiry_date' => 'required|date|after:today'
        ]);

        $coupon = new Coupon();

        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;

        $coupon->save();


        return redirect()->route('admin.coupons')->with('success', 'Coupon created successfully');
    }
    public function coupon_edit($id)
    {
        $coupon = Coupon::findOrfail($id);
        return view('admin.coupon-edit',compact('coupon'));
    }
    public function coupon_update(Request $request, $id)
    {
        $coupon = Coupon::findOrfail($id);
        $request->validate([
            'code' => 'required|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'cart_value' => 'required|numeric|min:0',
            'expiry_date' => 'required|date|after:today'
        ]);

       
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;

        $coupon->update();


        return redirect()->route('admin.coupons')->with('success', 'Coupon updated successfully');
    }
    public function coupon_destroy($id){
        $coupon = Coupon::findOrfail($id);
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('succes','coupon was deleted seccefully');
        

    }
}
