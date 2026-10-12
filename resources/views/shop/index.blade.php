<x-app-layout>
    <style>
        .costume-range-slider::-webkit-slider-thumb {
    pointer-events: auto;
    appearance: none;
    width: 16px;
    height: 16px;
    background: #0284c7;
    border-radius: 50%;
    cursor: pointer;
}

.costume-range-slider::-moz-range-thumb {
    pointer-events: auto;
    width: 16px;
    height: 16px;
    background: #0284c7;
    border-radius: 50%;
    border: none;
    cursor: pointer;
}
    </style>

    {{-- Page Banner --}}
    <div class="relative bg-sky-700 text-white h-64 flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset('assets/images/page-banner.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>

        <div class="relative z-10 text-center">
            <h2 class="text-4xl font-bold mb-2">Shop</h2>

            <ul class="flex justify-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('landing') }}" class="hover:text-primary">
                        Home
                    </a>
                </li>

                <li>/</li>

                <li class="text-primary">
                    Shop
                </li>
            </ul>
        </div>
    </div>


    {{-- Main Shop --}}
    <div class="container mx-auto px-4 py-16">

        {{-- IMPORTANT: One single form for filters --}}
        <form id="form-filter" method="GET" action="{{ route('shop.index') }}">

            <div class="flex flex-col lg:flex-row gap-8">

                {{-- ========================= --}}
                {{-- SIDEBAR --}}
                {{-- ========================= --}}
                <aside class="w-full lg:w-1/4 order-2 lg:order-1 space-y-8">
                  @if ( request()->anyFilled(['search','brand','category','min_price','max_price','sort_by','per_page']))
                  <div class="flex items-center space-x-2"> Filter Applied: 
                  <a href="{{ route('shop.index') }}" class="text-sm text-red-500 hover:text-primary">
                  <span class="text-sm text-red-600">Clear All Filters</span><i class="fa-solid fa-xmark" ></i></a> 
                  </div>
                  @endif  

                    {{-- Search --}}
                    <div class="bg-gray-50 p-6 rounded-lg border">

                        {{-- No nested form here --}}
                        <div class="relative">

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search product..."
                                class="w-full border p-3 rounded focus:outline-none focus:border-primary pr-10">

                            <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-primary">
                                <i class="fa fa-search"></i>
                            </button>

                        </div>

                    </div>




                    {{-- Categoreis --}}
                    <div class="bg-gray-50 p-6 rounded-lg border">

                        <h4 class="font-bold text-lg mb-4">
                            Categories
                        </h4>

                        <ul class="space-y-3">

                            @foreach ($categories as $category)
                                <li class="flex items-center">

                                    <label class="flex items-center cursor-pointer hover:text-primary">

                                        <input type="checkbox" class="custom-checkbox hidden peer filter-checkbox"
                                            name="category[]" value="{{ $category->id }}"
                                            {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}>

                                        <div
                                            class="w-4 h-4 border border-gray-300 rounded mr-3
                                                    flex items-center justify-center
                                                    bg-white transition
                                                    peer-checked:bg-primary
                                                    peer-checked:border-primary
                                                    text-transparent
                                                    peer-checked:text-white">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </div>

                                        {{ $category->name }} ({{ $category->products_count }})

                                    </label>

                                </li>
                            @endforeach

                        </ul>
                    </div>
                    {{-- Brand --}}
                    <div class="bg-gray-50 p-6 rounded-lg border">

                        <h4 class="font-bold text-lg mb-4">
                            Brands
                        </h4>

                        <ul class="space-y-3">

                            @foreach ($brands as $brand)
                                <li class="flex items-center">

                                    <label class="flex items-center cursor-pointer hover:text-primary">

                                        <input type="checkbox" class="custom-checkbox hidden peer filter-checkbox"
                                            name="brand[]" value="{{ $brand->id }}"
                                            {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}>

                                        <div
                                            class="w-4 h-4 border border-gray-300 rounded mr-3
                                                    flex items-center justify-center
                                                    bg-white transition
                                                    peer-checked:bg-primary
                                                    peer-checked:border-primary
                                                    text-transparent
                                                    peer-checked:text-white">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </div>

                                        {{ $brand->name }} ({{ $brand->products_count }})

                                    </label>

                                </li>
                            @endforeach

                        </ul>
                    </div>


                    <div class="bg-gray-50 p-6 rounded-lg border">
                        <h4 class="font-bold text-lg mb-4">
                            Filter By Price
                        </h4>

                        <div class="relative pt-6 pb-2">
                            <div class="absolute w-full h-1 bg-gray-300 rounded top-6 z-0"></div>

                            <div id="range-track" class="absolute h-1 bg-primary rounded top-6 z-10"
                                style="left: 0%; right: 0%;">
                            </div>

                            <input type="range" min="0" max="1000000" value="{{ request('min_price', 0) }}"
                                name="min_price"
                                class="absolute w-full h-1 bg-transparent appearance-none top-6 left-0 pointer-events-none z-20 costume-range-slider price-slider"
                                id="range-min">

                            <input type="range" min="0" max="1000000"
                                value="{{ request('max_price', 1000000) }}" name="max_price"
                                class="absolute w-full h-1 bg-transparent appearance-none top-6 left-0 pointer-events-none z-20 costume-range-slider price-slider"
                                id="range-max">

                            <div class="flex justify-between mt-4 text-sm font-medium text-gray-600">
                                <span>
                                    DA
                                    <span id="price-min-display">
                                        {{ request('min_price', 0) }}
                                    </span>
                                </span>

                                <span>
                                    DA
                                    <span id="price-max-display">
                                        {{ request('max_price', 1000000) }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>



                    {{-- Color Filter --}}
                    <div class="bg-gray-50 p-6 rounded-lg border">

                        <h4 class="font-bold text-lg mb-4">
                            Filter By Color
                        </h4>

                        <ul class="space-y-3">

                            <li class="flex items-center">

                                <input type="checkbox" id="c1" class="hidden peer">

                                <label for="c1"
                                    class="flex items-center cursor-pointer hover:text-primary peer-checked:text-primary group">
                                    <span
                                        class="w-4 h-4 rounded-full bg-blue-500 mr-3 border border-gray-200 group-hover:shadow-md"></span>
                                    Blue
                                </label>

                            </li>


                            <li class="flex items-center">

                                <input type="checkbox" id="c2" class="hidden peer">

                                <label for="c2"
                                    class="flex items-center cursor-pointer hover:text-primary peer-checked:text-primary group">
                                    <span
                                        class="w-4 h-4 rounded-full bg-green-500 mr-3 border border-gray-200 group-hover:shadow-md"></span>
                                    Green
                                </label>

                            </li>


                            <li class="flex items-center">

                                <input type="checkbox" id="c3" class="hidden peer">

                                <label for="c3"
                                    class="flex items-center cursor-pointer hover:text-primary peer-checked:text-primary group">
                                    <span
                                        class="w-4 h-4 rounded-full bg-gray-500 mr-3 border border-gray-200 group-hover:shadow-md"></span>
                                    Gray
                                </label>

                            </li>


                            <li class="flex items-center">

                                <input type="checkbox" id="c4" class="hidden peer">

                                <label for="c4"
                                    class="flex items-center cursor-pointer hover:text-primary peer-checked:text-primary group">
                                    <span
                                        class="w-4 h-4 rounded-full bg-black mr-3 border border-gray-200 group-hover:shadow-md"></span>
                                    Black
                                </label>

                            </li>

                        </ul>

                    </div>


                    {{-- Tags --}}
                    <div class="bg-gray-50 p-6 rounded-lg border">

                        <h4 class="font-bold text-lg mb-4">
                            Tags
                        </h4>

                        <div class="flex flex-wrap gap-2">

                            <a href="#"
                                class="px-3 py-1 bg-white border rounded text-sm hover:bg-primary hover:text-white transition">
                                Clothing
                            </a>

                            <a href="#"
                                class="px-3 py-1 bg-white border rounded text-sm hover:bg-primary hover:text-white transition">
                                Furniture
                            </a>

                            <a href="#"
                                class="px-3 py-1 bg-white border rounded text-sm hover:bg-primary hover:text-white transition">
                                Lights
                            </a>

                            <a href="#"
                                class="px-3 py-1 bg-white border rounded text-sm hover:bg-primary hover:text-white transition">
                                Modern
                            </a>

                        </div>

                    </div>

                </aside>


                {{-- ========================= --}}
                {{-- PRODUCTS --}}
                {{-- ========================= --}}
                <div class="w-full lg:w-3/4 order-1 lg:order-2">


                    {{-- Toolbar --}}
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center bg-white border p-4 rounded mb-8 shadow-sm">

                        {{-- Results --}}
                        <p class="text-sm mb-4 sm:mb-0">

                            Showing

                            <span class="font-bold text-primary">
                                {{ $products->firstItem() ?? 0 }}
                                -
                                {{ $products->lastItem() ?? 0 }}
                            </span>

                            of

                            <span class="font-bold">
                                {{ $products->total() }}
                            </span>

                            Results

                        </p>


                        <div class="flex items-center space-x-6">

                            {{-- Grid/List --}}
                            <div class="flex space-x-2">

                                <button type="button" id="btn-grid"
                                    class="w-8 h-8 flex items-center justify-center rounded bg-primary text-white transition">
                                    <i class="fa fa-th"></i>
                                </button>

                                <button type="button" id="btn-list"
                                    class="w-8 h-8 flex items-center justify-center rounded bg-gray-200 hover:bg-primary hover:text-white transition">
                                    <i class="fa fa-list"></i>
                                </button>

                            </div>


                            {{-- Sort --}}
                            <div class="flex items-center">

                                <span class="mr-2 text-sm font-medium">
                                    Sort By:
                                </span>

                                <select name="sort_by" onchange="this.form.submit()"
                                    class="border rounded p-1 text-sm focus:outline-none focus:border-primary">

                                    <option value="newest"
                                        {{ request('sort_by', 'newest') == 'newest' ? 'selected' : '' }}>
                                        Newest
                                    </option>

                                    <option value="price_asc"
                                        {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>
                                        Price: Low to High
                                    </option>

                                    <option value="price_desc"
                                        {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>
                                        Price: High to Low
                                    </option>

                                </select>

                            </div>


                            {{-- Per Page --}}
                            <div class="flex items-center">

                                <span class="mr-2 text-sm font-medium">
                                    View:
                                </span>

                                <select name="per_page" onchange="this.form.submit()"
                                    class="border rounded p-1 text-sm focus:outline-none focus:border-primary">

                                    <option value="12" {{ request('per_page', 12) == '12' ? 'selected' : '' }}>
                                        12 Products
                                    </option>

                                    <option value="24" {{ request('per_page') == '24' ? 'selected' : '' }}>
                                        24 Products
                                    </option>

                                    <option value="48" {{ request('per_page') == '48' ? 'selected' : '' }}>
                                        48 Products
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>


                    {{-- ========================= --}}
                    {{-- PRODUCT GRID --}}
                    {{-- ========================= --}}
                    <div id="product-grid-view" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                        @forelse($products as $product)
                            <div class="group">

                                <div class="relative overflow-hidden bg-gray-100 rounded-lg mb-4">

                                    <a href="{{ route('shop.show', $product->slug) }}">

                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-[300px] object-cover transition duration-500 group-hover:scale-105">
                                        @else
                                            <div
                                                class="w-full h-[300px] flex items-center justify-center text-gray-400">
                                                No Image
                                            </div>
                                        @endif

                                    </a>


                                    {{-- Product Actions --}}
                                    <div
                                        class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">

                                        <button type="button"
                                            class="w-10 h-10 bg-white rounded-full shadow hover:bg-primary hover:text-white flex items-center justify-center transition">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>


                                        <button type="button"
                                            class="w-10 h-10 bg-white rounded-full shadow hover:bg-primary hover:text-white flex items-center justify-center transition">
                                            <i class="fa-solid fa-bag-shopping"></i>
                                        </button>


                                        <a href="{{ route('shop.show', $product->slug) }}"
                                            class="w-10 h-10 bg-white rounded-full shadow hover:bg-primary hover:text-white flex items-center justify-center transition">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>

                                    </div>

                                </div>


                                {{-- Product Information --}}
                                <div class="text-center">

                                    <h4 class="text-lg font-medium hover:text-primary">

                                        <a href="{{ route('shop.show', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>

                                    </h4>


                                    {{-- Price --}}
                                    <div class="mt-1">

                                        @if ($product->sale_price && $product->sale_price < $product->price)
                                            <div class="flex flex-col">

                                                <span class="text-xl text-gray-400 line-through">
                                                    {{ number_format($product->price, 2) }} DA
                                                </span>

                                                <span class="text-2xl text-primary font-bold">
                                                    {{ number_format($product->sale_price, 2) }} DA
                                                </span>

                                            </div>
                                        @else
                                            <span class="text-2xl text-primary font-bold">
                                                {{ number_format($product->price, 2) }} DA
                                            </span>
                                        @endif

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="col-span-full text-center py-12">

                                <i class="fa-solid fa-box-open text-4xl text-gray-400 mb-4"></i>

                                <p class="text-gray-500">
                                    No products found.
                                </p>

                            </div>
                        @endforelse

                    </div>


                    {{-- ========================= --}}
                    {{-- LIST VIEW --}}
                    {{-- ========================= --}}
                    <div id="product-list-view" class="flex flex-col space-y-8 hidden">

                        {{-- You can populate this with the same products later --}}

                    </div>


                    {{-- Pagination --}}
                    <div class="mt-12 flex justify-center">

                        {{ $products->withQueryString()->links() }}

                    </div>

                </div>

            </div>

        </form>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-filter');
            const minSlider = document.getElementById('range-min');
            const maxSlider = document.getElementById('range-max');
            const minDisplay = document.getElementById('price-min-display');
            const maxDisplay = document.getElementById('price-max-display');
            const rangeTrack = document.getElementById('range-track');

            document.querySelectorAll('.auto-submit, .filter-checkbox').forEach(element => {
                element.addEventListener('change', () => {
                    form.submit();
                });
            });

            function updateRange() {
                let min = parseInt(minSlider.value);
                let max = parseInt(maxSlider.value);

                if (min > max) {
                    if (document.activeElement === minSlider) {
                        minSlider.value = max;
                        min = max;
                    } else {
                        maxSlider.value = min;
                        max = min;
                    }
                }

                const minPercent = (min / 1000000) * 100;
                const maxPercent = (max / 1000000) * 100;

                rangeTrack.style.left = minPercent + '%';
                rangeTrack.style.right = (100 - maxPercent) + '%';

                minDisplay.innerText = min;
                maxDisplay.innerText = max;
            }

            minSlider.addEventListener('input', updateRange);
            maxSlider.addEventListener('input', updateRange);

            let timeout = null;

            document.querySelectorAll('.price-slider').forEach(slider => {
                slider.addEventListener('change', function() {
                    clearTimeout(timeout);

                    timeout = setTimeout(() => {
                        form.submit();
                    }, 300);
                });
            });

            updateRange();
        });
    </script>

</x-app-layout>
