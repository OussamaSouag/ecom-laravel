<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\AuthAdmin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    $categories = Category::all();
    $brands = Brand::all();
    $products = Product::with('category')->latest()->take(8)->get();
    return view('welcome', compact('categories', 'products', 'brands'));
})->name('landing');
Route::get('shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('shop/{slug}', [ShopController::class, 'productDetails'])->name('shop.show');
//CART ROUTES
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
Route::put('/cart/update', [CartController::class, 'update_cart'])->name('cart.update');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove_from_cart'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear_cart'])->name('cart.clear');
Route::post('/cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name('cart.coupon.apply');
Route::delete('/cart/remove-coupon', [CartController::class, 'remove_coupon'])->name('cart.coupon.remove');
//CART ROUTES
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/store', [CheckoutController::class, 'OrderStore'])->name('order.store');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/products/{product:name}', [ProductController::class, 'show'])->name('product.show');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::middleware(AuthAdmin::class)->group(
    function () {
        // ADMIN ROUTE
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        // BRAND ROUTE
        Route::get('/admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
        Route::get('/admin/brand-add', [AdminController::class, 'brandAdd'])->name('admin.brand.add');
        Route::post('/admin/brands-add', [AdminController::class, 'brandStore'])->name('admin.brand.store');
        Route::get('/admin/brand/{brand}', [AdminController::class, 'brandEdit'])->name('admin.brand.edit');
        Route::put('/admin/brand/{id}', [AdminController::class, 'brandUpdate'])->name('admin.brand.update');
        Route::delete('/admin/brand/{id}', [AdminController::class, 'brandDestroy'])->name('admin.brand.destroy');
        //CATEGORIES ROUTE
        Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
        Route::get('/admin/category-add', [AdminController::class, 'categoriesAdd'])->name('admin.category.add');
        Route::post('/admin/categories', [AdminController::class, 'categoriesStore'])->name('admin.category.store');
        Route::get('/admin/category-edit/{category}', [AdminController::class, 'categoriesEdit'])->name('admin.category.edit');
        Route::put('/admin/category/{category}', [AdminController::class, 'categoriesUpdate'])->name('admin.category.update');
        Route::delete('/admin/category/{category}', [AdminController::class, 'categoriesDestroy'])->name('admin.category.delete');
        //PRODUCTS ROUTE
        Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
        Route::get('/admin/product-add', [AdminController::class, 'productsAdd'])->name('admin.product.add');
        Route::post('/admin/product', [AdminController::class, 'productsStore'])->name('admin.product.store');
        Route::get('/admin/product-edit/{id}', [AdminController::class, 'productsEdit'])->name('admin.product.edit');
        Route::put('/admin/product/{id}', [AdminController::class, 'productsUpdate'])->name('admin.product.update');
        Route::delete('/admin/product/{id}', [AdminController::class, 'productsDestroy'])->name('admin.product.destroy');
        Route::delete('/admin/products/bulk-delete', [AdminController::class, 'productsBulkDestroy'])->name('admin.products.bulkDestroy');
        Route::get('admin/product-export', [ProductController::class, 'productExport'])->name('admin.product.export');
        //COUPON ROUTE
        Route::get('/admin/coupons', [CouponController::class, 'coupon'])->name('admin.coupons');
        Route::get('/admin/coupon-add', [CouponController::class, 'coupon_add'])->name('admin.coupon.add');
        Route::post('/admin/coupon-store', [CouponController::class, 'coupon_store'])->name('admin.coupon.store');
        Route::get('/admin/coupon-edit/{id}', [CouponController::class, 'coupon_edit'])->name('admin.coupon.edit');
        Route::put('/admin/coupon/{id}', [CouponController::class, 'coupon_update'])->name('admin.coupon.update');
        Route::delete('/admin/coupon/{id}', [CouponController::class, 'coupon_destroy'])->name('admin.coupon.destroy');
        // ORDERS ROUTES
        Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders'); 
        Route::put('/admin/order/{id}/status', [AdminController::class, 'orderUpdateStatus']) ->name('admin.order.status');
    }
);

require __DIR__ . '/auth.php';
