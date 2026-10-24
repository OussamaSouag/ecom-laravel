<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OussMarket') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#020617] font-sans antialiased text-white">

    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col bg-[#0f172a] text-slate-300 transition-transform md:static md:translate-x-0">

            {{-- Logo --}}
            <div class="flex h-16 items-center px-6">

                <a href="{{ route('landing') }}">
                    <img src="{{ asset('storage/images/app-logo.webp') }}" alt="OussMarket" class="h-9 w-auto">
                </a>

            </div>


            {{-- Navigation --}}
            <div class="no-scrollbar flex-1 overflow-y-auto py-5">

                <nav class="space-y-1 px-3">

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                        class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-white/5 hover:text-white">
                        <i class="fa-solid fa-gauge-high w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>


                    {{-- Management --}}
                    <p class="px-4 pb-2 pt-6 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Management
                    </p>


                    {{-- Products --}}
                    <a href="{{ route('admin.products') }}"
                        class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-white/5 hover:text-white">
                        <i class="fa-solid fa-box w-5 text-center"></i>
                        <span>Products</span>
                    </a>


                    {{-- Categories --}}
                    <a href="{{ route('admin.categories') }}"
                        class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-white/5 hover:text-white">
                        <i class="fa-solid fa-layer-group w-5 text-center"></i>
                        <span>Categories</span>
                    </a>


                    {{-- Brands --}}
                    <a href="{{ route('admin.brands') }}"
                        class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-white/5 hover:text-white">
                        <i class="fa-solid fa-tag w-5 text-center"></i>
                        <span>Brands</span>
                    </a>
                    {{-- Coupons --}}
                    <a href="{{ route('admin.coupons') }}"
                        class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-white/5 hover:text-white">
                        <i class="fa-solid fa-ticket w-5 text-center"></i>
                        <span>Coupons</span>
                    </a>


                    {{-- Orders --}}
                    <a href="{{ route('admin.orders') }}"
                        class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-white/5 hover:text-white">
                        <i class="fa-solid fa-cart-shopping w-5 text-center"></i>
                        <span>Orders</span>
                    </a>


                    {{-- Customers --}}
                    <a href="#"
                        class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-white/5 hover:text-white">
                        <i class="fa-solid fa-users w-5 text-center"></i>
                        <span>Customers</span>
                    </a>


                    {{-- Reviews --}}
                    <a href="#"
                        class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-white/5 hover:text-white">
                        <i class="fa-regular fa-star w-5 text-center"></i>
                        <span>Reviews</span>
                    </a>


                    {{-- Settings --}}
                    <p class="px-4 pb-2 pt-6 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Settings
                    </p>


                    <a href="#"
                        class="nav-link flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-white/5 hover:text-white">
                        <i class="fa-solid fa-gear w-5 text-center"></i>
                        <span>General Settings</span>
                    </a>

                </nav>

            </div>


            {{-- Logout --}}
            <div class="p-3">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-400 transition hover:bg-white/5 hover:text-white">
                        <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                        <span>Logout</span>
                    </button>

                </form>

            </div>

        </aside>


        {{-- MOBILE OVERLAY --}}
        <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-black/60 md:hidden"></div>


        {{-- MAIN --}}
        <div class="flex min-w-0 flex-1 flex-col overflow-hidden">


            <header class="flex h-16 shrink-0 items-center justify-between bg-[#020617] px-6">

                {{-- Left side --}}
                <div class="flex items-center gap-4">

                    {{-- Mobile menu --}}
                    <button id="mobile-menu-btn" type="button"
                        class="text-slate-400 transition hover:text-white md:hidden">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>

                    {{-- Search --}}
                    <div class="relative hidden md:block w-[380px]">

                        <div
                            class="flex h-11 items-center rounded-xl border border-white/10 bg-[#0f172a] px-4 transition focus-within:border-blue-500/50 focus-within:ring-2 focus-within:ring-blue-500/10">

                            <i class="fa-solid fa-magnifying-glass text-sm text-slate-500"></i>

                            <input type="text" placeholder="Search products, orders..."
                                class="ml-3 h-full w-full border-0 bg-transparent text-sm text-white placeholder:text-slate-500 outline-none focus:ring-0">

                            <span
                                class="hidden lg:flex items-center rounded-md border border-white/10 bg-[#020617] px-2 py-1 text-[10px] font-medium text-slate-500">
                                Ctrl K
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Right side --}}
                <div class="flex items-center gap-5">

                    {{-- Notifications --}}
                    <button type="button"
                        class="relative flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 transition hover:bg-white/5 hover:text-white">
                        <i class="fa-regular fa-bell text-lg"></i>

                        <span class="absolute right-2.5 top-2 h-2 w-2 rounded-full bg-blue-500"></span>
                    </button>


                    {{-- Divider --}}
                    <div class="hidden h-8 w-px bg-white/10 sm:block"></div>


                    {{-- Admin --}}
                    <div class="flex items-center gap-3">

                        <div class="hidden text-right sm:block">

                            <p class="text-sm font-semibold text-white">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-slate-500">
                                {{ Auth::user()->role ?? 'Admin' }}
                            </p>

                        </div>


                        {{-- Avatar --}}
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-sm font-semibold text-white shadow-lg shadow-blue-600/20">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                    </div>

                </div>

            </header>


            {{-- MAIN CONTENT --}}
            <main class="flex-1 overflow-y-auto bg-[#020617]">

                {{ $slot }}

            </main>

        </div>

    </div>


    {{-- SIDEBAR SCRIPT --}}
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {

            const isClosed =
                sidebar.classList.contains('-translate-x-full');

            if (isClosed) {

                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');

            } else {

                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');

            }

        }

        mobileMenuBtn?.addEventListener('click', toggleSidebar);
        overlay?.addEventListener('click', toggleSidebar);


        // Active navigation
        document.addEventListener('DOMContentLoaded', function() {

            const currentLocation = window.location.pathname;

            const menuLinks = document.querySelectorAll('.nav-link');

            menuLinks.forEach(link => {

                const linkHref = link.getAttribute('href');

                if (
                    linkHref &&
                    linkHref !== '#' &&
                    currentLocation === new URL(
                        linkHref,
                        window.location.origin
                    ).pathname
                ) {

                    link.classList.add(
                        'bg-blue-600',
                        'text-white',
                        'shadow-lg',
                        'shadow-blue-600/20'
                    );

                    link.classList.remove(
                        'text-slate-300',
                        'hover:bg-white/5'
                    );

                }

            });

        });
    </script>

</body>

</html>
