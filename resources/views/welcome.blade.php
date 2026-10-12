<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OussMarket') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .swiper-button-next,
        .swiper-button-prev {
            color: #2563eb;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
            font-weight: 700;
        }

        .swiper-pagination-bullet-active {
            background: #2563eb;
        }

        .product-card {
            transition: .25s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(15, 23, 42, .08);
        }
    </style>
</head>

<body class="bg-white font-sans text-slate-700 antialiased">

    <!-- Header -->

    <header class="hidden lg:block sticky top-0 z-50 bg-white shadow-sm">
        <div class="mx-auto max-w-7xl px-6 py-4">
            <div class="flex items-center justify-between">

                <div class="w-1/4">
                    <a href="{{ route('landing') }}">
                        <img
                            src="{{ asset('storage/images/app-logo.webp') }}"
                            alt="OussMarket"
                            class="max-w-[180px] max-h-12 object-contain"
                        >
                    </a>
                </div>

                <div class="w-1/2 flex justify-center">
                    <nav>
                        <ul class="flex items-center gap-8 font-medium text-slate-700">

                            <li>
                                <a
                                    href="{{ route('landing') }}"
                                    class="transition hover:text-blue-600 {{ request()->routeIs('landing') ? 'text-blue-600' : '' }}"
                                >
                                    Home
                                </a>
                            </li>

                            <li>
                                <a
                                    href="{{ route('shop.index') }}"
                                    class="transition hover:text-blue-600 {{ request()->routeIs('shop.index') ? 'text-blue-600' : '' }}"
                                >
                                    Shop
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="transition hover:text-blue-600"
                                >
                                    Cart
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="transition hover:text-blue-600"
                                >
                                    Wishlist
                                </a>
                            </li>

                            <li>
                                <a
                                    href="{{ route('contact') }}"
                                    class="transition hover:text-blue-600"
                                >
                                    Contact
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>

                <div class="w-1/4 flex items-center justify-end gap-6">

                    <div class="relative group">
                        <button
                            type="button"
                            class="text-xl text-slate-700 transition hover:text-blue-600"
                        >
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

                        <div class="absolute right-0 top-full mt-3 w-72 rounded-xl border border-slate-100 bg-white p-3 opacity-0 invisible shadow-xl transition-all duration-200 group-hover:visible group-hover:opacity-100">

                            <form
                                action="{{ route('shop.index') }}"
                                method="GET"
                                class="flex"
                            >
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search products..."
                                    class="w-full rounded-l-lg border border-slate-200 px-3 py-2 text-sm outline-none focus:border-blue-500"
                                >

                                <button
                                    type="submit"
                                    class="rounded-r-lg bg-blue-600 px-4 text-white transition hover:bg-blue-500"
                                >
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>

                        </div>
                    </div>

                    <a
                        href="#"
                        class="text-xl text-slate-700 transition hover:text-blue-600"
                    >
                        <i class="fa-regular fa-heart"></i>
                    </a>

                    <a
                        href="#"
                        class="relative text-xl text-slate-700 transition hover:text-blue-600"
                    >
                        <i class="fa-solid fa-bag-shopping"></i>

                        <span class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-blue-600 text-[10px] font-bold text-white">
                            0
                        </span>
                    </a>

                    <div class="relative group">

                        <button
                            type="button"
                            class="text-xl text-slate-700 transition hover:text-blue-600"
                        >
                            <i class="fa-regular fa-user"></i>
                        </button>

                        <ul class="absolute right-0 top-full mt-3 w-44 overflow-hidden rounded-xl border border-slate-100 bg-white py-2 opacity-0 invisible shadow-xl transition-all duration-200 group-hover:visible group-hover:opacity-100">

                            @auth

                                <li>
                                    <a
                                        href="{{ auth()->user()->role === 'user' ? route('dashboard') : route('admin.index') }}"
                                        class="block px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-blue-600"
                                    >
                                        My Account
                                    </a>
                                </li>

                                <li>
                                    <form
                                        method="POST"
                                        action="{{ route('logout') }}"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="block w-full px-4 py-2 text-left text-sm text-slate-700 transition hover:bg-slate-50 hover:text-blue-600"
                                        >
                                            Sign Out
                                        </button>
                                    </form>
                                </li>

                            @else

                                <li>
                                    <a
                                        href="{{ route('login') }}"
                                        class="block px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-blue-600"
                                    >
                                        Sign In
                                    </a>
                                </li>

                                <li>
                                    <a
                                        href="{{ route('register') }}"
                                        class="block px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-50 hover:text-blue-600"
                                    >
                                        Register
                                    </a>
                                </li>

                            @endauth

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </header>


    <!-- Mobile Header -->

    <header class="sticky top-0 z-50 bg-white shadow-sm lg:hidden">

        <div class="px-4 py-4">

            <div class="mb-4 flex items-center justify-between">

                <button
                    id="mobile-menu-btn"
                    type="button"
                    class="text-xl text-slate-700"
                >
                    <i class="fa-solid fa-bars"></i>
                </button>

                <a href="{{ route('landing') }}">
                    <img
                        src="{{ asset('storage/images/app-logo.webp') }}"
                        alt="OussMarket"
                        class="max-w-[120px] max-h-10 object-contain"
                    >
                </a>

                <div class="flex items-center gap-5">

                    <a
                        href="#"
                        class="text-lg text-slate-700 hover:text-blue-600"
                    >
                        <i class="fa-regular fa-heart"></i>
                    </a>

                    <a
                        href="#"
                        class="relative text-lg text-slate-700 hover:text-blue-600"
                    >
                        <i class="fa-solid fa-bag-shopping"></i>

                        <span class="absolute -right-2 -top-2 flex h-4 w-4 items-center justify-center rounded-full bg-blue-600 text-[9px] text-white">
                            0
                        </span>
                    </a>

                    <div class="relative">

                        <button
                            id="mobile-avatar-button"
                            type="button"
                            class="text-lg text-slate-700 hover:text-blue-600"
                        >
                            <i class="fa-regular fa-user"></i>
                        </button>

                        <ul
                            id="avatar-submenu-mobile"
                            class="absolute right-0 top-full mt-3 hidden w-44 overflow-hidden rounded-xl border border-slate-100 bg-white py-2 shadow-xl"
                        >

                            @auth

                                <li>
                                    <a
                                        href="{{ auth()->user()->role === 'user' ? route('dashboard') : route('admin.index') }}"
                                        class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
                                    >
                                        My Account
                                    </a>
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button
                                            type="submit"
                                            class="block w-full px-4 py-2 text-left text-sm text-slate-700 hover:bg-slate-50"
                                        >
                                            Sign Out
                                        </button>
                                    </form>
                                </li>

                            @else

                                <li>
                                    <a
                                        href="{{ route('login') }}"
                                        class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
                                    >
                                        Sign In
                                    </a>
                                </li>

                                <li>
                                    <a
                                        href="{{ route('register') }}"
                                        class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
                                    >
                                        Register
                                    </a>
                                </li>

                            @endauth

                        </ul>

                    </div>

                </div>

            </div>

            <form
                action="{{ route('shop.index') }}"
                method="GET"
                class="relative"
            >
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search for products..."
                    class="w-full rounded-lg bg-slate-100 px-4 py-2.5 pr-11 text-sm outline-none transition focus:bg-white focus:ring-2 focus:ring-blue-500"
                >

                <button
                    type="submit"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-600"
                >
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

        </div>

    </header>


    <!-- Mobile Sidebar -->

    <div
        id="mobile-sidebar"
        class="fixed inset-y-0 left-0 z-[60] w-72 -translate-x-full bg-white shadow-2xl transition-transform duration-300"
    >

        <div class="flex items-center justify-between border-b border-slate-100 p-5">

            <span class="font-bold text-lg text-slate-900">
                Menu
            </span>

            <button
                id="close-menu-btn"
                type="button"
                class="text-xl text-slate-700"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

        <nav class="p-5">

            <ul class="space-y-5 font-medium">

                <li>
                    <a
                        href="{{ route('landing') }}"
                        class="block hover:text-blue-600"
                    >
                        Home
                    </a>
                </li>

                <li>
                    <a
                        href="{{ route('shop.index') }}"
                        class="block hover:text-blue-600"
                    >
                        Shop
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="block hover:text-blue-600"
                    >
                        Cart
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="block hover:text-blue-600"
                    >
                        Wishlist
                    </a>
                </li>

                <li>
                    <a
                        href="{{ route('contact') }}"
                        class="block hover:text-blue-600"
                    >
                        Contact
                    </a>
                </li>

            </ul>

        </nav>

    </div>

    <div
        id="menu-overlay"
        class="fixed inset-0 z-[55] hidden bg-black/40"
    ></div>


    <!-- Hero Slider -->

    <section class="relative overflow-hidden bg-slate-50">

        <div class="swiper main-slider h-[520px] lg:h-[620px]">

            <div class="swiper-wrapper">

                <div class="swiper-slide flex items-center">

                    <div class="mx-auto grid h-full max-w-7xl items-center gap-10 px-6 lg:grid-cols-2">

                        <div class="text-center lg:text-left">

                            <span class="inline-block rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600">
                                Welcome to OussMarket
                            </span>

                            <h1 class="mt-5 text-4xl font-bold leading-tight text-slate-900 sm:text-5xl lg:text-6xl">
                                Discover products
                                <span class="text-blue-600">you'll love.</span>
                            </h1>

                            <p class="mt-5 max-w-xl text-lg leading-8 text-slate-500">
                                Find quality products, trusted brands and great deals all in one place.
                            </p>

                            <a
                                href="{{ route('shop.index') }}"
                                class="mt-8 inline-flex rounded-xl bg-blue-600 px-7 py-3.5 font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500"
                            >
                                Shop Now
                            </a>

                        </div>

                        <div class="hidden lg:flex justify-center">

                            <img
                                src="{{ asset('storage/images/slider/slider-item-1.png') }}"
                                alt="OussMarket products"
                                class="max-h-[430px] w-auto object-contain"
                            >

                        </div>

                    </div>

                </div>


                <div class="swiper-slide flex items-center">

                    <div class="mx-auto grid h-full max-w-7xl items-center gap-10 px-6 lg:grid-cols-2">

                        <div class="text-center lg:text-left">

                            <span class="inline-block rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600">
                                Quality & Value
                            </span>

                            <h2 class="mt-5 text-4xl font-bold leading-tight text-slate-900 sm:text-5xl lg:text-6xl">
                                Shop smarter.
                                <span class="text-blue-600">Live better.</span>
                            </h2>

                            <p class="mt-5 max-w-xl text-lg leading-8 text-slate-500">
                                Explore our latest products and discover something that fits your needs and budget.
                            </p>

                            <a
                                href="{{ route('shop.index') }}"
                                class="mt-8 inline-flex rounded-xl bg-blue-600 px-7 py-3.5 font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500"
                            >
                                Explore Products
                            </a>

                        </div>

                        <div class="hidden lg:flex justify-center">

                            <img
                                src="{{ asset('storage/images/slider/slider-item-2.png') }}"
                                alt="OussMarket products"
                                class="max-h-[430px] w-auto object-contain"
                            >

                        </div>

                    </div>

                </div>

            </div>

            <div class="swiper-pagination"></div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>

    </section>


    <!-- Categories -->

    <section class="bg-slate-50 py-16">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mb-10 text-center">

                <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">
                    Browse
                </p>

                <h2 class="mt-2 text-3xl font-bold uppercase tracking-wide text-slate-900">
                    Popular Categories
                </h2>

            </div>

            <div class="swiper category-slider overflow-hidden">

                <div class="swiper-wrapper pb-10">

                    @forelse($categories ?? [] as $category)

                        <div class="swiper-slide text-center">

                            <a
                                href="{{ route('shop.index', ['category' => $category->id]) }}"
                                class="group block rounded-2xl border border-transparent bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:border-slate-100 hover:shadow-xl"
                            >

                                <div class="flex h-28 items-center justify-center">

                                    @if($category->image)

                                        <img
                                            src="{{ asset('storage/' . $category->image) }}"
                                            alt="{{ $category->name }}"
                                            class="h-24 w-24 object-contain opacity-80 transition group-hover:scale-105 group-hover:opacity-100"
                                        >

                                    @else

                                        <i class="fa-solid fa-layer-group text-5xl text-slate-300"></i>

                                    @endif

                                </div>

                            </a>

                            <h4 class="mt-5 text-xs font-semibold uppercase tracking-widest text-slate-600">
                                {{ $category->name }}
                            </h4>

                        </div>

                    @empty

                        <div class="swiper-slide py-10 text-center text-slate-400">
                            No categories available.
                        </div>

                    @endforelse

                </div>

                <div class="swiper-pagination"></div>

            </div>

        </div>

    </section>


    <!-- Services -->

    <section class="bg-white py-12">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="grid gap-6 md:grid-cols-3">

                <div class="rounded-2xl border border-slate-100 bg-white p-7 text-center transition hover:-translate-y-1 hover:shadow-lg">

                    <img
                        src="{{ asset('storage/images/icon/icon-1.png') }}"
                        alt="Fast Delivery"
                        class="mx-auto mb-5 h-16"
                    >

                    <h3 class="text-xl font-bold text-slate-900">
                        Fast Delivery
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Get your orders delivered quickly and safely.
                    </p>

                </div>

                <div class="rounded-2xl border border-slate-100 bg-white p-7 text-center transition hover:-translate-y-1 hover:shadow-lg">

                    <img
                        src="{{ asset('storage/images/icon/icon-2.png') }}"
                        alt="Safe Payment"
                        class="mx-auto mb-5 h-16"
                    >

                    <h3 class="text-xl font-bold text-slate-900">
                        Safe Payment
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Shop with confidence using secure payment options.
                    </p>

                </div>

                <div class="rounded-2xl border border-slate-100 bg-white p-7 text-center transition hover:-translate-y-1 hover:shadow-lg">

                    <img
                        src="{{ asset('storage/images/icon/icon-3.png') }}"
                        alt="Online Support"
                        class="mx-auto mb-5 h-16"
                    >

                    <h3 class="text-xl font-bold text-slate-900">
                        Online Support
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Our support team is here whenever you need help.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- Brands -->

    <section class="bg-white py-16">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mb-10 text-center">

                <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">
                    Trusted
                </p>

                <h2 class="mt-2 text-3xl font-bold uppercase tracking-wide text-slate-900">
                    Our Partner Brands
                </h2>

            </div>

            <div class="grid grid-cols-2 items-center gap-5 md:grid-cols-3 lg:grid-cols-5">

                @forelse($brands ?? [] as $brand)

                    <a
                        href="{{ route('shop.index', ['brand' => [$brand->id]]) }}"
                        class="group flex flex-col items-center"
                    >

                        <div class="flex h-32 w-full items-center justify-center rounded-2xl border border-transparent p-5 grayscale transition-all duration-300 group-hover:border-slate-100 group-hover:bg-white group-hover:grayscale-0 group-hover:shadow-lg">

                            @if($brand->image)

                                <img
                                    src="{{ asset('storage/' . $brand->image) }}"
                                    alt="{{ $brand->name }}"
                                    class="max-h-full max-w-full object-contain"
                                >

                            @else

                                <span class="font-semibold text-slate-500">
                                    {{ $brand->name }}
                                </span>

                            @endif

                        </div>

                        <p class="mt-4 text-center text-sm font-semibold uppercase tracking-wider text-slate-500 transition group-hover:text-blue-600">
                            {{ $brand->name }}
                        </p>

                    </a>

                @empty

                    <div class="col-span-full py-10 text-center text-slate-400">
                        No brands available.
                    </div>

                @endforelse

            </div>

        </div>

    </section>


    <!-- New Products -->

    <section class="bg-white py-16">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mb-10 flex items-end justify-between">

                <div>

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">
                        Latest
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        New Products
                    </h2>

                </div>

                <a
                    href="{{ route('shop.index') }}"
                    class="hidden font-semibold text-blue-600 transition hover:text-blue-500 sm:block"
                >
                    View All
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>

            </div>


            <div class="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-4">

                @forelse($products ?? [] as $product)

                    <div class="product-card group relative">

                        <div class="relative overflow-hidden rounded-2xl bg-slate-100">

                            <a href="{{ route('shop.show', ['slug' => $product->slug]) }}">

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="h-[300px] w-full object-contain p-6 transition duration-500 group-hover:scale-105"
                                    >

                                @else

                                    <div class="flex h-[300px] items-center justify-center">
                                        <i class="fa-solid fa-image text-5xl text-slate-300"></i>
                                    </div>

                                @endif

                            </a>


                            @if($product->sale_price)

                                <span class="absolute left-4 top-4 rounded-lg bg-red-500 px-2 py-1 text-xs font-bold text-white">
                                    SALE
                                </span>

                            @endif


                            <div class="absolute right-4 top-4 flex translate-x-4 flex-col gap-2 opacity-0 transition duration-300 group-hover:translate-x-0 group-hover:opacity-100">

                                <a
                                    href="{{ route('shop.show', ['slug' => $product->slug]) }}"
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow transition hover:bg-blue-600 hover:text-white"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <button
                                    type="button"
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow transition hover:bg-blue-600 hover:text-white"
                                >
                                    <i class="fa-regular fa-heart"></i>
                                </button>

                                <button
                                    type="button"
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow transition hover:bg-blue-600 hover:text-white"
                                >
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </button>

                            </div>

                        </div>


                        <div class="mt-4 text-center">

                            <h4 class="text-lg font-medium text-slate-800 transition hover:text-blue-600">

                                <a href="{{ route('shop.show', ['slug' => $product->slug]) }}">
                                    {{ $product->name }}
                                </a>

                            </h4>


                            @if($product->sale_price)

                                <div class="mt-1 flex items-center justify-center gap-2">

                                    <span class="font-bold text-blue-600">
                                        {{ number_format($product->sale_price, 0, ',', ' ') }} DA
                                    </span>

                                    <span class="text-sm text-slate-400 line-through">
                                        {{ number_format($product->price, 0, ',', ' ') }} DA
                                    </span>

                                </div>

                            @else

                                <p class="mt-1 font-bold text-blue-600">
                                    {{ number_format($product->price, 0, ',', ' ') }} DA
                                </p>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="col-span-full py-16 text-center text-slate-400">
                        No products available.
                    </div>

                @endforelse

            </div>

        </div>

    </section>


    <!-- Promotional Banners -->

    <section class="bg-white py-16">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="grid gap-8 md:grid-cols-2">

                <div class="group relative overflow-hidden rounded-2xl">

                    <img
                        src="{{ asset('storage/images/banner/banner-05.jpg') }}"
                        alt="New Products"
                        class="h-[300px] w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    <div class="absolute inset-0 flex flex-col items-start justify-center bg-white/40 p-8">

                        <p class="text-sm font-bold uppercase text-slate-600">
                            High Quality
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-slate-900">
                            Discover New<br>
                            Products
                        </h3>

                        <a
                            href="{{ route('shop.index') }}"
                            class="mt-5 rounded-lg bg-blue-600 px-6 py-2.5 font-semibold text-white transition hover:bg-blue-500"
                        >
                            Shop Now
                        </a>

                    </div>

                </div>


                <div class="group relative overflow-hidden rounded-2xl">

                    <img
                        src="{{ asset('storage/images/banner/banner-06.jpg') }}"
                        alt="Best Products"
                        class="h-[300px] w-full object-cover transition duration-500 group-hover:scale-105"
                    >

                    <div class="absolute inset-0 flex flex-col items-start justify-center bg-white/40 p-8">

                        <p class="text-sm font-bold uppercase text-slate-600">
                            Best Quality
                        </p>

                        <h3 class="mt-2 text-3xl font-bold text-slate-900">
                            Find Your<br>
                            Next Favorite
                        </h3>

                        <a
                            href="{{ route('shop.index') }}"
                            class="mt-5 rounded-lg bg-blue-600 px-6 py-2.5 font-semibold text-white transition hover:bg-blue-500"
                        >
                            Shop Now
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- Special Offer -->

    <section class="overflow-hidden bg-slate-50 py-16">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="grid items-center gap-12 lg:grid-cols-2">

                <div>

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">
                        Special Offer
                    </p>

                    <h2 class="mt-3 text-4xl font-bold text-slate-900">
                        Great Deals
                        <span class="text-blue-600">Every Day</span>
                    </h2>

                    <p class="mt-5 max-w-xl leading-7 text-slate-500">
                        Discover selected products and special prices available at OussMarket.
                    </p>

                    <div class="mt-8 flex gap-3">

                        <div class="rounded-xl bg-white p-4 text-center shadow-sm">
                            <span class="block text-2xl font-bold text-blue-600">
                                00
                            </span>
                            <span class="text-xs uppercase text-slate-400">
                                Days
                            </span>
                        </div>

                        <div class="rounded-xl bg-white p-4 text-center shadow-sm">
                            <span class="block text-2xl font-bold text-blue-600">
                                00
                            </span>
                            <span class="text-xs uppercase text-slate-400">
                                Hours
                            </span>
                        </div>

                        <div class="rounded-xl bg-white p-4 text-center shadow-sm">
                            <span class="block text-2xl font-bold text-blue-600">
                                00
                            </span>
                            <span class="text-xs uppercase text-slate-400">
                                Mins
                            </span>
                        </div>

                        <div class="rounded-xl bg-white p-4 text-center shadow-sm">
                            <span class="block text-2xl font-bold text-blue-600">
                                00
                            </span>
                            <span class="text-xs uppercase text-slate-400">
                                Secs
                            </span>
                        </div>

                    </div>

                    <a
                        href="{{ route('shop.index') }}"
                        class="mt-8 inline-block rounded-xl bg-blue-600 px-7 py-3.5 font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500"
                    >
                        Shop Now
                    </a>

                </div>


                <div class="flex justify-center">

                    <img
                        src="{{ asset('storage/images/countdown.png') }}"
                        alt="Special Offer"
                        class="max-h-[420px] w-full max-w-md object-contain"
                    >

                </div>

            </div>

        </div>

    </section>


    <!-- Featured Products -->

    <section class="bg-white py-16">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mb-8 flex items-end justify-between">

                <div>

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">
                        Discover
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        Featured Products
                    </h2>

                </div>

                <div class="flex gap-2">

                    <button
                        type="button"
                        class="feat-prev flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 transition hover:border-blue-600 hover:bg-blue-600 hover:text-white"
                    >
                        <i class="fa-solid fa-angle-left"></i>
                    </button>

                    <button
                        type="button"
                        class="feat-next flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 transition hover:border-blue-600 hover:bg-blue-600 hover:text-white"
                    >
                        <i class="fa-solid fa-angle-right"></i>
                    </button>

                </div>

            </div>


            <div class="swiper featured-slider overflow-hidden">

                <div class="swiper-wrapper">

                    @forelse($featuredProducts ?? $products ?? [] as $product)

                        <div class="swiper-slide">

                            <div class="group text-center">

                                <div class="relative mb-4 overflow-hidden rounded-2xl bg-slate-100">

                                    <a href="{{ route('shop.show', ['slug' => $product->slug]) }}">

                                        @if($product->image)

                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="h-72 w-full object-contain p-6 transition duration-500 group-hover:scale-105"
                                            >

                                        @else

                                            <div class="flex h-72 items-center justify-center">
                                                <i class="fa-solid fa-image text-5xl text-slate-300"></i>
                                            </div>

                                        @endif

                                    </a>

                                </div>

                                <h4 class="font-medium text-slate-800">

                                    <a
                                        href="{{ route('shop.show', ['slug' => $product->slug]) }}"
                                        class="transition hover:text-blue-600"
                                    >
                                        {{ $product->name }}
                                    </a>

                                </h4>

                                <p class="font-bold text-blue-600">
                                    {{ number_format($product->sale_price ?? $product->price, 0, ',', ' ') }} DA
                                </p>

                            </div>

                        </div>

                    @empty

                        <div class="swiper-slide py-10 text-center text-slate-400">
                            No featured products available.
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </section>


    <!-- Footer -->

    <footer class="bg-slate-900 py-16 text-slate-300">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-4">

                <div>

                    <img
                        src="{{ asset('storage/images/app-logo.webp') }}"
                        alt="OussMarket"
                        class="mb-6 max-w-[180px] max-h-12 object-contain"
                    >

                    <ul class="space-y-3 text-sm">

                        <li>
                            Algeria
                        </li>

                        <li>
                            Call Us:
                            <a
                                href="tel:+213000000000"
                                class="transition hover:text-blue-400"
                            >
                                +213 000 000 000
                            </a>
                        </li>

                        <li>
                            Email:
                            <a
                                href="mailto:contact@oussmarket.com"
                                class="transition hover:text-blue-400"
                            >
                                contact@oussmarket.com
                            </a>
                        </li>

                    </ul>

                    <div class="mt-6 flex gap-3">

                        <a
                            href="#"
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 transition hover:bg-blue-600"
                        >
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>

                        <a
                            href="#"
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 transition hover:bg-blue-600"
                        >
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a
                            href="#"
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-800 transition hover:bg-blue-600"
                        >
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>

                    </div>

                </div>


                <div>

                    <h4 class="mb-6 text-lg font-bold text-white">
                        Our Categories
                    </h4>

                    <ul class="space-y-3 text-sm">

                        @forelse($categories ?? [] as $category)

                            <li>
                                <a
                                    href="{{ route('shop.index', ['category' => $category->id]) }}"
                                    class="transition hover:text-blue-400"
                                >
                                    {{ $category->name }}
                                </a>
                            </li>

                        @empty

                            <li class="text-slate-500">
                                No categories
                            </li>

                        @endforelse

                    </ul>

                </div>


                <div>

                    <h4 class="mb-6 text-lg font-bold text-white">
                        Information
                    </h4>

                    <ul class="space-y-3 text-sm">

                        <li>
                            <a
                                href="#"
                                class="transition hover:text-blue-400"
                            >
                                About Us
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="transition hover:text-blue-400"
                            >
                                How to Shop
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="transition hover:text-blue-400"
                            >
                                FAQ
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('contact') }}"
                                class="transition hover:text-blue-400"
                            >
                                Contact Us
                            </a>
                        </li>

                    </ul>

                </div>


                <div>

                    <h4 class="mb-6 text-lg font-bold text-white">
                        My Account
                    </h4>

                    <ul class="space-y-3 text-sm">

                        @guest

                            <li>
                                <a
                                    href="{{ route('login') }}"
                                    class="transition hover:text-blue-400"
                                >
                                    Sign In
                                </a>
                            </li>

                            <li>
                                <a
                                    href="{{ route('register') }}"
                                    class="transition hover:text-blue-400"
                                >
                                    Register
                                </a>
                            </li>

                        @else

                            <li>
                                <a
                                    href="{{ auth()->user()->role === 'user' ? route('dashboard') : route('admin.index') }}"
                                    class="transition hover:text-blue-400"
                                >
                                    My Account
                                </a>
                            </li>

                        @endguest

                        <li>
                            <a
                                href="#"
                                class="transition hover:text-blue-400"
                            >
                                View Cart
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="transition hover:text-blue-400"
                            >
                                My Wishlist
                            </a>
                        </li>

                    </ul>

                </div>

            </div>


            <div class="mt-12 flex flex-col items-center justify-between gap-5 border-t border-slate-700 pt-8 md:flex-row">

                <p class="text-sm">
                    &copy; {{ date('Y') }} OussMarket. All rights reserved.
                </p>

                <div class="flex items-center gap-3 text-slate-400">

                    <span class="text-sm">
                        Secure shopping
                    </span>

                    <i class="fa-solid fa-shield-halved"></i>

                </div>

            </div>

        </div>

    </footer>


    <!-- Back To Top -->

    <button
        id="back-to-top"
        type="button"
        class="fixed bottom-8 right-8 z-50 hidden h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg transition hover:bg-blue-500"
    >
        <i class="fa-solid fa-chevron-up"></i>
    </button>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const closeMenuBtn = document.getElementById('close-menu-btn');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const menuOverlay = document.getElementById('menu-overlay');

            function openMenu() {
                mobileSidebar.classList.remove('-translate-x-full');
                menuOverlay.classList.remove('hidden');
            }

            function closeMenu() {
                mobileSidebar.classList.add('-translate-x-full');
                menuOverlay.classList.add('hidden');
            }

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', openMenu);
            }

            if (closeMenuBtn) {
                closeMenuBtn.addEventListener('click', closeMenu);
            }

            if (menuOverlay) {
                menuOverlay.addEventListener('click', closeMenu);
            }


            const avatarButton = document.getElementById('mobile-avatar-button');
            const avatarMenu = document.getElementById('avatar-submenu-mobile');

            if (avatarButton && avatarMenu) {
                avatarButton.addEventListener('click', function (event) {
                    event.stopPropagation();
                    avatarMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function () {
                    avatarMenu.classList.add('hidden');
                });
            }


            new Swiper('.main-slider', {
                loop: true,

                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },

                pagination: {
                    el: '.main-slider .swiper-pagination',
                    clickable: true
                },

                navigation: {
                    nextEl: '.main-slider .swiper-button-next',
                    prevEl: '.main-slider .swiper-button-prev'
                }
            });


            new Swiper('.category-slider', {
                slidesPerView: 1.5,
                spaceBetween: 16,

                breakpoints: {
                    640: {
                        slidesPerView: 2.5
                    },

                    768: {
                        slidesPerView: 4
                    },

                    1024: {
                        slidesPerView: 5
                    },

                    1280: {
                        slidesPerView: 6
                    }
                }
            });


            new Swiper('.featured-slider', {
                slidesPerView: 1.2,
                spaceBetween: 20,

                navigation: {
                    nextEl: '.feat-next',
                    prevEl: '.feat-prev'
                },

                breakpoints: {
                    640: {
                        slidesPerView: 2
                    },

                    768: {
                        slidesPerView: 3
                    },

                    1024: {
                        slidesPerView: 4
                    }
                }
            });


            const backToTop = document.getElementById('back-to-top');

            window.addEventListener('scroll', function () {

                if (window.scrollY > 500) {
                    backToTop.classList.remove('hidden');
                    backToTop.classList.add('flex');
                } else {
                    backToTop.classList.add('hidden');
                    backToTop.classList.remove('flex');
                }

            });

            backToTop.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

        });
    </script>

</body>
</html>