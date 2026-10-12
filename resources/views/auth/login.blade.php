<x-guest-layout>

    <div class="min-h-screen bg-[#020617] px-4 py-12 text-white">

        <div class="mx-auto w-full max-w-md">

            {{-- Logo / Header --}}
            <div class="mb-8 text-center">

                <a
                    href="{{ route('landing') }}"
                    class="inline-flex items-center"
                >
                    <img
                        src="{{ asset('storage/images/app-logo.webp') }}"
                        alt="OussMarket"
                        class="h-10 w-auto"
                    >
                </a>

                <h1 class="mt-8 text-3xl font-bold tracking-tight">
                    Welcome back
                </h1>

                <p class="mt-2 text-sm text-slate-400">
                    Sign in to your OussMarket account
                </p>

            </div>


            {{-- Login Card --}}
            <div
                class="rounded-2xl border border-white/10
                       bg-[#0f172a] p-6 shadow-2xl
                       shadow-black/20 sm:p-8"
            >

                {{-- Session Status --}}
                <x-auth-session-status
                    class="mb-5"
                    :status="session('status')"
                />


                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-slate-200"
                        >
                            Email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="you@example.com"
                            class="block w-full rounded-xl
                                   border border-white/10
                                   bg-[#020617]
                                   px-4 py-3
                                   text-sm text-white
                                   placeholder:text-slate-600
                                   outline-none transition
                                   focus:border-blue-500/60
                                   focus:ring-2
                                   focus:ring-blue-500/20"
                        >

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Password --}}
                    <div class="mt-5">

                        <div class="mb-2 flex items-center justify-between">

                            <label
                                for="password"
                                class="block text-sm font-medium text-slate-200"
                            >
                                Password
                            </label>

                            @if (Route::has('password.request'))
                                <a
                                    href="{{ route('password.request') }}"
                                    class="text-xs font-medium
                                           text-blue-400
                                           transition hover:text-blue-300"
                                >
                                    Forgot password?
                                </a>
                            @endif

                        </div>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="block w-full rounded-xl
                                   border border-white/10
                                   bg-[#020617]
                                   px-4 py-3
                                   text-sm text-white
                                   placeholder:text-slate-600
                                   outline-none transition
                                   focus:border-blue-500/60
                                   focus:ring-2
                                   focus:ring-blue-500/20"
                        >

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Remember Me --}}
                    <div class="mt-5">

                        <label class="inline-flex cursor-pointer items-center">

                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="h-4 w-4 rounded
                                       border-white/20
                                       bg-[#020617]
                                       text-blue-600
                                       focus:ring-blue-500/30"
                            >

                            <span class="ms-2 text-sm text-slate-400">
                                Remember me
                            </span>

                        </label>

                    </div>


                    {{-- Login Button --}}
                    <button
                        type="submit"
                        class="mt-7 flex w-full items-center
                               justify-center rounded-xl
                               bg-blue-600 px-4 py-3
                               text-sm font-semibold text-white
                               shadow-lg shadow-blue-600/20
                               transition duration-200
                               hover:bg-blue-500
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-500/40"
                    >
                        Log in
                    </button>

                </form>


                {{-- Register --}}
                @if (Route::has('register'))

                    <div class="my-6 flex items-center gap-4">
                        <div class="h-px flex-1 bg-white/10"></div>

                        <span class="text-xs text-slate-500">
                            OR
                        </span>

                        <div class="h-px flex-1 bg-white/10"></div>
                    </div>

                    <div class="text-center">

                        <p class="text-sm text-slate-400">
                            Don't have an account?
                        </p>

                        <a
                            href="{{ route('register') }}"
                            class="mt-3 inline-flex w-full
                                   items-center justify-center
                                   rounded-xl
                                   border border-white/10
                                   bg-white/5
                                   px-4 py-3
                                   text-sm font-semibold
                                   text-white
                                   transition
                                   hover:border-blue-500/30
                                   hover:bg-white/10"
                        >
                            Create an account
                        </a>

                    </div>

                @endif

            </div>


            {{-- Back to store --}}
            <div class="mt-6 text-center">

                <a
                    href="{{ route('landing') }}"
                    class="text-sm text-slate-500
                           transition hover:text-slate-300"
                >
                    ← Back to OussMarket
                </a>

            </div>

        </div>

    </div>

</x-guest-layout>