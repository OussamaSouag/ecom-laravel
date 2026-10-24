<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\laravel\Facades\Image;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function brands()
    {
        $query = Brand::query();
        if ($search = request('search')) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }
        $brands = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        return view('admin.brands', compact('brands'));
    }
    public function brandAdd()
    {
        return view('admin.brand-add');
    }
    public function brandStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $brand->status = $request->has('status') ? 1 : 0;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $brand->image = $imagePath;
        }
        $brand->save();
        return redirect()->route('admin.brands')->with('success', 'Brand Added successfully');
    }
    public function brandEdit($brand)
    {
        $brandEdited = Brand::findOrfail($brand);
        return view('admin.brand-edit', compact('brandEdited'));
    }
    public function brandUpdate(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp,svg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);
        $brand->name = $validated['name'];
        $brand->slug = Str::slug($validated['slug']);
        $brand->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $brand->image = $imagePath;
        }
        $brand->save();
        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully');
    }
    public function brandDestroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->route('admin.brands')->with('success', 'Brand deleted successfully');
    }
    public function categories()
    {

        $query = Category::query();
        if ($search = request('search')) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }
        $categories = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        return view('admin.categories', compact('categories'));
    }
    public function categoriesAdd()
    {
        $parentCategories = Category::where('parent_id', null)->orderBy('name', 'ASC')->get();
        return view('admin.categories-add', compact('parentCategories'));
    }
    public function categoriesStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg,gif|max:2028',
            'status' => 'boolean|nullable'
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }
        Category::create($validated);
        return redirect()->route('admin.categories')->with('successe', 'Category created successfuly');
    }
    public function categoriesEdit($category)
    {
        $Ecategories = Category::findOrFail($category);
        $parentCategories = Category::where('parent_id', null)->orderBy('name', 'ASC')->get();
        return view('admin.categories-edit', compact('Ecategories', 'parentCategories'));
    }
    public function categoriesUpdate(Request $request, $category)
    {
        $Ucategories = Category::findOrFail($category);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $Ucategories->id,
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg,gif|max:2028',
            'status' => 'boolean|nullable'
        ]);

        $Ucategories->slug = Str::slug($validated['slug']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }
        $Ucategories->update($validated);
        return redirect()->route('admin.categories')->with('successe', 'Category updated successfuly');
    }
    public function categoriesDestroy($category)
    {
        $Dcategory = Category::findOrFail($category);
        $Dcategory->delete();
        return redirect()->route('admin.categories')->with('successe', 'Category deleted successfuly');
    }
    public function products(Request $request)
    {
        $sort_by = request()->input('sort_by', 'created_at');
        $sort_order = request()->input('sort_order', 'desc');
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        $products = Product::with('category', 'brand')->orderBy('created_at', 'ASC')->paginate(10);
        $query = Product::query('category', 'brand');
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        $products = $query->get();
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }
        $products = $query->get();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')->orWhere('SKU', 'like', '%' . $request->search . '%');
        }
        $products = $query->orderBy($sort_by, $sort_order)->paginate(10)->withQueryString();


        $products = $query->get();
        return view('admin.products', compact('products', 'categories', 'brands'));
    }
    public function productsAdd()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-add', compact('categories', 'brands'));
    }
    public function productsStore(Request $request)
    {
        // dd($request->brand_id);
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'description' => 'required|string|min:10|max:1000',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',

            'slug' => 'nullable|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string|max:500',
            'SKU' => 'nullable|string|max:100|unique:products,SKU',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:8192',
        ]);

        // Main image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Gallery images
        if ($request->hasFile('images')) {
            $gallery = [];

            foreach ($request->file('images') as $file) {
                $gallery[] = $file->store('products', 'public');
            }

            $validated['images'] = implode(',', $gallery);
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product created successfully');
    }
    public function productsEdit($id)
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        $product = Product::findOrFail($id);
        return view('admin.product-edit', compact('categories', 'brands', 'product'));
    }
    public function productsUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',

            'description' => 'required|string|min:10|max:1000',

            'short_description' => 'nullable|string|max:500',

            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,

            'SKU' => 'required|string|max:100|unique:products,sku,' . $product->id,

            'price' => 'required|numeric|min:0',

            'sale_price' => 'nullable|numeric|min:0|lte:price',

            'stock' => 'required|integer|min:0',

            'category_id' => 'required|integer|exists:categories,id',

            'brand_id' => 'required|integer|exists:brands,id',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',

            'images' => 'nullable|array|max:10',

            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:8192',
        ]);


        // Main image
        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }


        // Gallery images
        if ($request->hasFile('images')) {

            $gallery = [];

            foreach ($request->file('images') as $file) {
                $gallery[] = $file->store('products', 'public');
            }

            $validated['images'] = implode(',', $gallery);
        }


        // Update product
        $product->update($validated);


        return redirect()
            ->route('admin.products')
            ->with('success', 'Product updated successfully');
    }
    public function productsdestroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product deleted successfully');
    }
    public function productsBulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:products,id',
        ]);

        Product::whereIn('id', $request->ids)->delete();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Selected products deleted successfully.');
    }
    public function orders(Request $request)
    {
        $query = Order::with('items')->latest();

        // Search by order ID, customer name, or phone number
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('number', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $q->orWhere('id', $search);
                }
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders', compact('orders'));
    }

    public function orderUpdateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,confirmed,processing,shipped,delivered,cancelled',
            ],
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.orders')
            ->with('success', 'Order status updated successfully.');
    }
}
