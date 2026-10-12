<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Sorting
        $sortBy = $request->input('sort_by', 'newest');

        match ($sortBy) {
            'price_asc' => $query->orderBy('price', 'asc'),

            'price_desc' => $query->orderBy('price', 'desc'),

            'featured' => $query->where('is_featured', true),

            default => $query->latest(),
        };

        // Products per page
        $perPage = $request->input('per_page', 12);

        if ($request->filled('brand')) {
            $brandIds = $request->input('brand',[]);
            $query->whereIn('brand_id',$brandIds);
        }
        if ($request->filled('category')) {
            $categoryIds = $request->input('category',[]);
            $query->whereIn('category_id',$categoryIds);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }
         if ($request->filled('search')) {
            $search = $request->input('search') ;
            $query->where(function ($q) use ($search)  {
                $q->where('name','LIKE','%'.$search.'%')
                ->orWhere('description','LIKE','%'.$search.'%')
                ->orWhere('brand_id','LIKE','%'.$search.'%');
            });
            
        }

        $products = $query
            ->paginate($perPage)
            ->withQueryString();


        $brands=Brand::withCount('products')->orderBy('name','ASC')->get();
        $categories=Category::withCount('products')->orderBy('name','ASC')->get();
        return view('shop.index', compact('products','brands','categories'));
    }
    public function productDetails(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $Rproduct = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->orderby('created_at', 'desc')
            ->take(8)
            ->get();
        return view('shop.show', compact('product', 'Rproduct'));
    }
}

