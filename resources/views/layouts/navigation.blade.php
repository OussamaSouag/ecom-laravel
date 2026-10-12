<nav
    x-data="{ open: false }"
  x-data="{ open: false }"class="{{ request()->routeIs('landing')? 'absolute inset-x-0 top-0 z-50 bg-transparent': 'relative z-50 bg-[#020617]' }}"
        >
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative flex h-20 items-center justify-between">

            {{-- Logo --}}
            <div class="flex items-center">
                <a
                    href="{{ route('landing') }}"
                    class="flex items-center rounded-lg focus:outline-none"
                >
                    <img
                        src="{{ asset('storage/images/app-logo.webp') }}"
                        alt="OussMarket"
                        class="block h-9 w-auto"
                    >
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden items-center gap-8 lg:flex">
                
                {{-- Home --}}
                @auth
                @if(Auth::user()->role =='admin')
                <a
                    href="{{ route('admin.index') }}"
                    class="text-sm font-medium transition
                        {{ request()->routeIs('admin.index')
                            ? 'text-white'
                            : 'text-slate-400 hover:text-white' }}"
                >
                    Admin Panel
                </a>
                @endif
                @endauth
                <a
                    href="{{ route('landing') }}"
                    class="text-sm font-medium transition
                        {{ request()->routeIs('landing')
                            ? 'text-white'
                            : 'text-slate-400 hover:text-white' }}"
                >
                    Home
                </a>
                
                {{-- Products --}}
                <a
                    href="{{ route('product.index') }}"
                    class="text-sm font-medium transition
                        {{ request()->routeIs('product.index')
                            ? 'text-white'
                            : 'text-slate-400 hover:text-white' }}"
                >
                    Products
                </a>

                {{-- Contact --}}
                <a
                    href="{{ route('contact') }}"
                    class="text-sm font-medium transition
                        {{ request()->routeIs('contact')
                            ? 'text-white'
                            : 'text-slate-400 hover:text-white' }}"
                >
                    Contact Us
                </a>

            </div>

            {{-- Right Side --}}
            <div class="flex items-center gap-3">

                {{-- Search --}}
                <form
                    action="{{ route('product.index') }}"
                    method="GET"
                    class="hidden items-center md:flex"
                >
                    <div class="relative">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search products..."
                            class="w-56 rounded-xl border border-white/10
                                   bg-white/5 py-2.5 pl-4 pr-11
                                   text-sm text-white
                                   placeholder:text-slate-500
                                   outline-none transition
                                   focus:border-blue-500/50
                                   focus:bg-white/[0.07]
                                   focus:ring-2 focus:ring-blue-500/10
                                   lg:w-64"
                        >

                        <button
                            type="submit"
                            class="absolute right-1.5 top-1/2
                                   flex h-8 w-8 -translate-y-1/2
                                   items-center justify-center
                                   rounded-lg text-slate-400
                                   transition
                                   hover:bg-blue-600
                                   hover:text-white"
                        >
                            <svg
                                class="h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.34-4.34"/>
                            </svg>
                        </button>

                    </div>
                </form>

                {{-- Cart --}}
                <button
                    type="button"
                    class="relative flex h-10 w-10 items-center
                           justify-center rounded-xl
                           border border-white/10
                           bg-white/5
                           text-slate-300
                           transition
                           hover:border-blue-500/30
                           hover:bg-blue-600
                           hover:text-white"
                >
                    <svg
                        class="h-5 w-5"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <circle cx="8" cy="21" r="1"/>
                        <circle cx="19" cy="21" r="1"/>
                        <path
                            d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0
                               1.95 1.58h9.78a2 2 0 0 0 1.95-1.57
                               l1.65-7.43H5.12"
                        />
                    </svg>
                </button>

                {{-- Authentication --}}
                @auth

                    {{-- User dropdown --}}
                    <div class="hidden sm:block">

                        <x-dropdown align="right" width="48">

                            <x-slot name="trigger">
                                <button
                                    class="flex items-center gap-2 rounded-xl
                                           border border-white/10
                                           bg-white/5 px-3 py-2
                                           text-sm font-medium
                                           text-slate-300
                                           transition
                                           hover:bg-white/10
                                           hover:text-white
                                           focus:outline-none"
                                >
                                    <span>
                                        {{ Auth::user()->name }}
                                    </span>

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m6 9 6 6 6-6"
                                        />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link
                                    :href="route('profile.edit')"
                                >
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}"
                                >
                                    @csrf

                                    <x-dropdown-link
                                        :href="route('logout')"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                    >
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>

                            </x-slot>

                        </x-dropdown>

                    </div>

                @else

                    {{-- Login --}}
                    <a
                        href="{{ route('login') }}"
                        class="hidden rounded-xl px-4 py-2
                               text-sm font-medium
                               text-slate-300
                               transition
                               hover:bg-white/5
                               hover:text-white
                               sm:inline-flex"
                    >
                        Log in
                    </a>

                    {{-- Register --}}
                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="hidden rounded-xl
                                   bg-blue-600
                                   px-4 py-2
                                   text-sm font-semibold
                                   text-white
                                   shadow-lg
                                   shadow-blue-600/20
                                   transition
                                   hover:bg-blue-500
                                   sm:inline-flex"
                        >
                            Register
                        </a>
                    @endif

                @endauth

                {{-- Mobile menu button --}}
                <button
                    @click="open = !open"
                    type="button"
                    class="flex h-10 w-10 items-center
                           justify-center rounded-xl
                           border border-white/10
                           bg-white/5
                           text-slate-300
                           transition
                           hover:bg-white/10
                           hover:text-white
                           sm:hidden"
                >

                    {{-- Menu --}}
                    <svg
                        x-show="!open"
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    {{-- Close --}}
                    <svg
                        x-show="open"
                        x-cloak
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div
            x-show="open"
            x-cloak
            x-transition
            class="border-t border-white/5 py-4 lg:hidden"
        >

            <div class="space-y-1">

                <a
                    href="{{ route('landing') }}"
                    class="block rounded-lg px-4 py-3 text-sm font-medium
                           transition
                           {{ request()->routeIs('landing')
                               ? 'bg-white/5 text-white'
                               : 'text-slate-400 hover:bg-white/5 hover:text-white' }}"
                >
                    Home
                </a>

                <a
                    href="{{ route('product.index') }}"
                    class="block rounded-lg px-4 py-3 text-sm font-medium
                           transition
                           {{ request()->routeIs('product.index')
                               ? 'bg-white/5 text-white'
                               : 'text-slate-400 hover:bg-white/5 hover:text-white' }}"
                >
                    Products
                </a>

                <a
                    href="{{ route('contact') }}"
                    class="block rounded-lg px-4 py-3 text-sm font-medium
                           transition
                           {{ request()->routeIs('contact')
                               ? 'bg-white/5 text-white'
                               : 'text-slate-400 hover:bg-white/5 hover:text-white' }}"
                >
                    Contact Us
                </a>

            </div>

            {{-- Mobile Search --}}
            <form
                action="{{ route('product.index') }}"
                method="GET"
                class="mt-4"
            >
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search products..."
                    class="w-full rounded-xl border border-white/10
                           bg-white/5 px-4 py-3
                           text-sm text-white
                           placeholder:text-slate-500
                           outline-none
                           focus:border-blue-500/50
                           focus:ring-2 focus:ring-blue-500/10"
                >
            </form>

            {{-- Mobile Authentication --}}
            <div class="mt-4 border-t border-white/5 pt-4">

                @auth

                    <div class="px-4 py-2">
                        <p class="text-sm text-slate-400">
                            Signed in as
                        </p>

                        <p class="mt-1 font-medium text-white">
                            {{ Auth::user()->name }}
                        </p>
                    </div>

                    <a
                        href="{{ route('profile.edit') }}"
                        class="mt-2 block rounded-lg px-4 py-3
                               text-sm text-slate-300
                               transition
                               hover:bg-white/5
                               hover:text-white"
                    >
                        Profile
                    </a>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="w-full rounded-lg px-4 py-3
                                   text-left text-sm text-slate-300
                                   transition
                                   hover:bg-white/5
                                   hover:text-white"
                        >
                            Log Out
                        </button>
                    </form>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="block rounded-lg px-4 py-3
                               text-sm text-slate-300
                               transition
                               hover:bg-white/5
                               hover:text-white"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="mt-1 block rounded-lg
                                   bg-blue-600 px-4 py-3
                                   text-center text-sm font-semibold
                                   text-white
                                   transition
                                   hover:bg-blue-500"
                        >
                            Register
                        </a>
                    @endif

                @endauth

            </div>

        </div>
    </div>
</nav>