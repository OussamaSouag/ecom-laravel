<x-app-layout>

    @push('styles')
        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        {{-- Swiper --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    @endpush


    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <div class="relative h-64 bg-[#0f172a] text-white flex items-center justify-center overflow-hidden">

        <div class="absolute inset-0 bg-gradient-to-b from-[#020617]/40 to-[#020617]"></div>

        <div class="relative z-10 text-center px-4">

            <h2 class="text-4xl font-bold mb-3">
                Product Details
            </h2>

            <ul class="flex items-center justify-center gap-2 text-sm text-slate-400">

                <li>
                    <a href="{{ route('landing') }}" class="hover:text-blue-500 transition">
                        Home
                    </a>
                </li>

                <li>/</li>

                <li class="text-blue-500">
                    {{ $product->name }}
                </li>

            </ul>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- PRODUCT SECTION --}}
    {{-- ========================================================= --}}

    <section class="py-16 bg-[#020617]">

        <div class="container mx-auto px-4">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">


                <div class="flex gap-4">

                    {{-- Thumbnails --}}
                    <div class="flex flex-col gap-3 w-20">

                        {{-- Main image thumbnail --}}
                        @if ($product->image)
                            <button type="button"
                                onclick="changeMainImage('{{ asset('storage/' . $product->image) }}')"
                                class="gallery-thumb w-20 h-20 rounded-xl bg-[#0f172a] border border-white/10 overflow-hidden p-2">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-full h-full object-contain" alt="{{ $product->name }}">
                            </button>
                        @endif


                        {{-- Gallery images --}}
                        @if ($product->images)

                            @foreach (explode(',', $product->images) as $galleryImage)
                                @php
                                    $galleryImage = trim($galleryImage);
                                @endphp

                                @if ($galleryImage)
                                    <button type="button"
                                        onclick="changeMainImage('{{ asset('storage/' . $galleryImage) }}')"
                                        class="gallery-thumb w-20 h-20 rounded-xl bg-[#0f172a] border border-white/10 overflow-hidden p-2">
                                        <img src="{{ asset('storage/' . $galleryImage) }}"
                                            class="w-full h-full object-contain" alt="{{ $product->name }}">
                                    </button>
                                @endif
                            @endforeach

                        @endif

                    </div>


                    {{-- Main image --}}
                    <div
                        class="flex-1 h-[500px] bg-[#0f172a] rounded-2xl overflow-hidden flex items-center justify-center">

                        @if ($product->image)
                            <img id="mainProductImage" src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}" class="w-full h-full object-contain p-6">
                        @endif

                    </div>

                </div>


                <script>
                    function changeMainImage(image) {
                        document.getElementById('mainProductImage').src = image;
                    }
                </script>


                {{-- ================================================= --}}
                {{-- PRODUCT INFORMATION --}}
                {{-- ================================================= --}}

                <div class="w-full text-white">


                    {{-- Product Name --}}
                    <h1 class="text-3xl lg:text-4xl font-bold mb-4">

                        {{ $product->name }}

                    </h1>



                    {{-- Rating --}}
                    <div class="flex items-center gap-4 mb-6">

                        <div class="text-yellow-400 text-sm">

                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>

                        </div>

                        <a href="#review" class="text-sm text-slate-400 hover:text-blue-500 transition">
                            (0 Customer Reviews)
                        </a>

                    </div>



                    {{-- Price --}}
                    <div class="flex items-center gap-4 mb-6">

                        @if ($product->sale_price)
                            <span class="text-3xl text-blue-500 font-bold">

                                ${{ number_format($product->sale_price, 2) }}

                            </span>

                            <span class="text-xl text-slate-500 line-through">

                                ${{ number_format($product->price, 2) }}

                            </span>
                        @else
                            <span class="text-3xl text-blue-500 font-bold">

                                ${{ number_format($product->price, 2) }}

                            </span>
                        @endif

                    </div>



                    {{-- Short Description --}}
                    <p class="text-slate-300 leading-relaxed mb-8">

                        {{ $product->short_description ?? $product->description }}

                    </p>



                    {{-- Stock --}}
                    <div class="mb-6">

                        @if ($product->stock > 0)
                            <span class="inline-flex items-center text-green-400 font-medium">

                                <i class="fa-solid fa-circle-check mr-2"></i>

                                In Stock

                                <span class="ml-1">
                                    ({{ $product->stock }})
                                </span>

                            </span>
                        @else
                            <span class="inline-flex items-center text-red-400 font-medium">

                                <i class="fa-solid fa-circle-xmark mr-2"></i>

                                Out of Stock

                            </span>
                        @endif

                    </div>



                    {{-- Quantity + Cart --}}
                    <form action="{{ route('cart.add') }}" method="POST" class="flex flex-wrap items-center gap-4 mb-8">
                      @csrf  
                        <input type="hidden" name="product_id" value="{{ $product->id }}" >
                        <input type="hidden" name="price" value="{{ $product->sale_price ? $product->sale_price : $product->price }}" >
                        <input type="hidden" name="name" value="{{ $product->name }}" >
                        {{-- Quantity --}}
                        <div class="flex items-center overflow-hidden rounded-xl border border-white/10 bg-[#0f172a]">

                            <button type="button" onclick="updateQty(-1)"
                                class="w-11 h-11 text-slate-300 hover:bg-blue-600 hover:text-white transition">
                                -
                            </button>

                            <input type="number" name="quantity" id="qty-input" value="1" min="1"
                                max="{{ max($product->stock, 1) }}" readonly
                                class="w-12 h-11 bg-transparent border-0 text-white text-center focus:outline-none">

                            <button type="button" onclick="updateQty(1)"
                                class="w-11 h-11 text-slate-300 hover:bg-blue-600 hover:text-white transition">
                                +
                            </button>

                        </div>



                        {{-- Add To Cart --}}
                        <button type="submit" @if ($product->stock <= 0) disabled @endif
                            class="px-8 py-3 rounded-xl bg-blue-600 text-white font-medium hover:bg-blue-500 disabled:bg-slate-700 disabled:text-slate-500 transition">

                            <i class="fa-solid fa-bag-shopping mr-2"></i>

                            Add To Cart

                        </button>



                        {{-- Wishlist --}}
                        <button type="button"
                            class="w-11 h-11 flex items-center justify-center rounded-xl bg-[#0f172a] border border-white/10 hover:bg-blue-600 transition">

                            <i class="fa-regular fa-heart"></i>

                        </button>



                        {{-- Compare --}}
                        <button type="button"
                            class="w-11 h-11 flex items-center justify-center rounded-xl bg-[#0f172a] border border-white/10 hover:bg-blue-600 transition">

                            <i class="fa-solid fa-shuffle"></i>

                        </button>

                    </form>



                    {{-- ================================================= --}}
                    {{-- PRODUCT META --}}
                    {{-- ================================================= --}}

                    <div class="border-t border-white/10 pt-6 space-y-4 text-sm text-slate-300">


                        {{-- SKU --}}
                        <div class="flex">

                            <span class="w-24 font-semibold text-white">
                                SKU:
                            </span>

                            <span>
                                {{ $product->SKU }}
                            </span>

                        </div>



                        {{-- Category --}}
                        <div class="flex">

                            <span class="w-24 font-semibold text-white">
                                Category:
                            </span>

                            @if ($product->category)
                                <a href="{{ route('shop.index', ['category' => $product->category_id]) }}"
                                    class="hover:text-blue-500 transition">

                                    {{ $product->category->name }}

                                </a>
                            @else
                                <span>
                                    N/A
                                </span>
                            @endif

                        </div>



                        {{-- Brand --}}
                        <div class="flex">

                            <span class="w-24 font-semibold text-white">
                                Brand:
                            </span>

                            @if ($product->brand)
                                <a href="{{ route('shop.index', ['brand' => $product->brand_id]) }}"
                                    class="hover:text-blue-500 transition">

                                    {{ $product->brand->name }}

                                </a>
                            @else
                                <span>
                                    N/A
                                </span>
                            @endif

                        </div>



                        {{-- Share --}}
                        <div class="flex items-center">

                            <span class="w-24 font-semibold text-white">
                                Share:
                            </span>

                            <div class="flex items-center gap-4">

                                <a href="#" class="text-slate-400 hover:text-blue-500 transition">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>

                                <a href="#" class="text-slate-400 hover:text-blue-500 transition">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>

                                <a href="#" class="text-slate-400 hover:text-blue-500 transition">
                                    <i class="fa-brands fa-pinterest-p"></i>
                                </a>

                                <a href="#" class="text-slate-400 hover:text-blue-500 transition">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- PRODUCT DETAILS TABS --}}
    {{-- ========================================================= --}}

    <section id="details-tabs" class="py-14 bg-[#0f172a]">

        <div class="container mx-auto px-4">


            {{-- Tab Buttons --}}
            <div class="flex justify-center gap-2 border-b border-white/10 mb-8 overflow-x-auto">

                <button type="button"
                    class="tab-btn active px-6 py-3 text-white font-medium whitespace-nowrap hover:text-blue-500 transition"
                    data-target="info">
                    Information
                </button>

                <button type="button"
                    class="tab-btn px-6 py-3 text-slate-400 font-medium whitespace-nowrap hover:text-blue-500 transition"
                    data-target="desc">
                    Description
                </button>

                <button type="button"
                    class="tab-btn px-6 py-3 text-slate-400 font-medium whitespace-nowrap hover:text-blue-500 transition"
                    data-target="review">
                    Reviews (0)
                </button>

            </div>



            <div class="max-w-4xl mx-auto text-slate-300">


                {{-- Information --}}
                <div id="info" class="tab-content space-y-4">

                    <h3 class="text-xl font-bold text-white mb-6">
                        Product Information
                    </h3>

                    <p>
                        <strong class="text-white">
                            SKU:
                        </strong>

                        {{ $product->SKU }}
                    </p>

                    <p>
                        <strong class="text-white">
                            Stock:
                        </strong>

                        {{ $product->stock }}
                    </p>

                    @if ($product->brand)
                        <p>

                            <strong class="text-white">
                                Brand:
                            </strong>

                            {{ $product->brand->name }}

                        </p>
                    @endif

                    @if ($product->category)
                        <p>

                            <strong class="text-white">
                                Category:
                            </strong>

                            {{ $product->category->name }}

                        </p>
                    @endif

                </div>



                {{-- Description --}}
                <div id="desc" class="tab-content hidden">

                    <h3 class="text-xl font-bold text-white mb-6">
                        Description
                    </h3>

                    <p class="leading-relaxed">
                        {{ $product->description }}
                    </p>

                </div>



                {{-- Reviews --}}
                <div id="review" class="tab-content hidden">

                    <div class="mb-10">

                        <h3 class="text-xl font-bold text-white mb-4">
                            Customer Reviews
                        </h3>

                        <p class="text-slate-400">
                            No reviews yet.
                        </p>

                    </div>



                    {{-- Review Form --}}
                    <div class="bg-[#020617] p-6 rounded-2xl border border-white/10">

                        <h3 class="text-xl font-bold text-white mb-6">
                            Add a review
                        </h3>

                        <form class="space-y-5">


                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <input type="text" placeholder="Enter your name"
                                    class="w-full p-3 rounded-xl bg-[#0f172a] border border-white/10 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-0 outline-none">

                                <input type="email" placeholder="john.smith@example.com"
                                    class="w-full p-3 rounded-xl bg-[#0f172a] border border-white/10 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-0 outline-none">

                            </div>



                            <div>

                                <label class="block mb-2 text-white font-medium">
                                    Rating:
                                </label>

                                <div class="flex gap-1 text-slate-500 hover:text-yellow-400 cursor-pointer">

                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>

                                </div>

                            </div>



                            <textarea placeholder="Write your comments here"
                                class="w-full h-32 p-3 rounded-xl bg-[#0f172a] border border-white/10 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-0 outline-none"></textarea>



                            <button type="submit"
                                class="px-6 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-500 transition">
                                Submit Review
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- RELATED PRODUCTS --}}
    {{-- ========================================================= --}}

    <section class="py-16 bg-[#020617]">

        <div class="container mx-auto px-4">


            {{-- Heading --}}
            <div class="mb-8">

                <p class="text-blue-500 text-sm font-semibold uppercase tracking-wider mb-2">
                    You may also like
                </p>

                <h2 class="text-3xl font-bold text-white">
                    Related Products
                </h2>

            </div>



            @if ($Rproduct->count() > 0)

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">


                    @foreach ($Rproduct as $related)
                        <div class="group">


                            {{-- Product Card Image --}}
                            <div
                                class="relative aspect-square overflow-hidden rounded-2xl bg-[#0f172a] border border-white/10 mb-4">


                                <a href="{{ route('shop.show', ['slug' => $related->slug]) }}"
                                    class="block w-full h-full">

                                    @if ($related->image)
                                        <img src="{{ asset('storage/' . $related->image) }}"
                                            alt="{{ $related->name }}"
                                            class="w-full h-full object-contain p-5 group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-600">

                                            <i class="fa-solid fa-image text-5xl"></i>

                                        </div>
                                    @endif

                                </a>



                                {{-- Card Actions --}}
                                <div
                                    class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 opacity-0 group-hover:opacity-100 transition duration-300">


                                    {{-- View --}}
                                    <a href="{{ route('shop.show', ['slug' => $related->slug]) }}"
                                        title="View Product"
                                        class="w-10 h-10 rounded-xl bg-[#020617]/90 border border-white/10 text-white flex items-center justify-center hover:bg-blue-600 transition">

                                        <i class="fa-solid fa-magnifying-glass"></i>

                                    </a>



                                    {{-- Cart --}}
                                    <button type="button" title="Add To Cart"
                                        class="w-10 h-10 rounded-xl bg-[#020617]/90 border border-white/10 text-white flex items-center justify-center hover:bg-blue-600 transition">

                                        <i class="fa-solid fa-bag-shopping"></i>

                                    </button>



                                    {{-- Wishlist --}}
                                    <button type="button" title="Add To Wishlist"
                                        class="w-10 h-10 rounded-xl bg-[#020617]/90 border border-white/10 text-white flex items-center justify-center hover:bg-blue-600 transition">

                                        <i class="fa-regular fa-heart"></i>

                                    </button>

                                </div>

                            </div>



                            {{-- Product Name --}}
                            <h4 class="font-semibold text-white">

                                <a href="{{ route('shop.show', ['slug' => $related->slug]) }}"
                                    class="hover:text-blue-500 transition">

                                    {{ $related->name }}

                                </a>

                            </h4>



                            {{-- Brand --}}
                            @if ($related->brand)
                                <p class="text-xs text-slate-500 mt-1">

                                    {{ $related->brand->name }}

                                </p>
                            @endif



                            {{-- Price --}}
                            <div class="mt-2">

                                @if ($related->sale_price)
                                    <span class="text-blue-500 font-bold">

                                        ${{ number_format($related->sale_price, 2) }}

                                    </span>

                                    <span class="text-sm text-slate-500 line-through ml-2">

                                        ${{ number_format($related->price, 2) }}

                                    </span>
                                @else
                                    <span class="text-blue-500 font-bold">

                                        ${{ number_format($related->price, 2) }}

                                    </span>
                                @endif

                            </div>



                            {{-- Stock --}}
                            @if ($related->stock > 0)
                                <p class="text-xs text-green-400 mt-2">

                                    <i class="fa-solid fa-circle-check mr-1"></i>

                                    In Stock

                                </p>
                            @else
                                <p class="text-xs text-red-400 mt-2">

                                    <i class="fa-solid fa-circle-xmark mr-1"></i>

                                    Out of Stock

                                </p>
                            @endif

                        </div>
                    @endforeach

                </div>
            @else
                <div class="text-center py-12">

                    <i class="fa-solid fa-box-open text-4xl text-slate-600 mb-4"></i>

                    <p class="text-slate-500">
                        No related products found.
                    </p>

                </div>

            @endif

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {


            /*
            |--------------------------------------------------------------------------
            | Product Gallery
            |--------------------------------------------------------------------------
            */

            let galleryThumbs = null;


            /*
            |--------------------------------------------------------------------------
            | Vertical Thumbnails
            |--------------------------------------------------------------------------
            */

            if (document.querySelector('.gallery-thumbs')) {

                galleryThumbs = new Swiper('.gallery-thumbs', {

                    direction: 'vertical',

                    spaceBetween: 10,

                    slidesPerView: 6,

                    freeMode: true,

                    watchSlidesProgress: true,

                    mousewheel: true,

                });

            }



            /*
            |--------------------------------------------------------------------------
            | Main Gallery
            |--------------------------------------------------------------------------
            */

            if (document.querySelector('.gallery-top')) {

                new Swiper('.gallery-top', {

                    slidesPerView: 1,

                    spaceBetween: 10,

                    navigation: {

                        nextEl: '.gallery-next',

                        prevEl: '.gallery-prev',

                    },

                    thumbs: galleryThumbs ?
                        {
                            swiper: galleryThumbs
                        } :
                        undefined,

                });

            }



            /*
            |--------------------------------------------------------------------------
            | Product Tabs
            |--------------------------------------------------------------------------
            */

            const tabButtons = document.querySelectorAll('.tab-btn');

            const tabContents = document.querySelectorAll('.tab-content');


            tabButtons.forEach(function(button) {

                button.addEventListener('click', function() {


                    tabButtons.forEach(function(btn) {

                        btn.classList.remove('active');

                        btn.classList.remove('text-white');

                        btn.classList.add('text-slate-400');

                    });


                    tabContents.forEach(function(content) {

                        content.classList.add('hidden');

                    });


                    button.classList.add('active');

                    button.classList.remove('text-slate-400');

                    button.classList.add('text-white');


                    const targetId = button.getAttribute('data-target');

                    const target = document.getElementById(targetId);


                    if (target) {

                        target.classList.remove('hidden');

                    }

                });

            });



            /*
            |--------------------------------------------------------------------------
            | Quantity
            |--------------------------------------------------------------------------
            */

            window.updateQty = function(amount) {

                const input = document.getElementById('qty-input');


                if (!input) {

                    return;

                }


                let value = parseInt(input.value) || 1;

                let max = parseInt(input.getAttribute('max')) || 1;


                value += amount;


                if (value < 1) {

                    value = 1;

                }


                if (value > max) {

                    value = max;

                }


                input.value = value;

            };

        });
    </script>

</x-app-layout>
