<x-guest-layout>

    <div class="min-h-screen bg-[#020617] px-4 py-12 text-white">

        <div class="mx-auto w-full max-w-md">

            {{-- Logo + Heading --}}
            <div class="mb-8 text-center">

                <a href="{{ route('landing') }}" class="inline-block">
                    <img
                        src="{{ asset('storage/images/app-logo.webp') }}"
                        alt="OussMarket"
                        class="h-10 w-auto"
                    >
                </a>

                <h1 class="mt-8 text-3xl font-bold tracking-tight">
                    Create your account
                </h1>

                <p class="mt-2 text-sm text-slate-400">
                    Join OussMarket and start shopping
                </p>

            </div>


            {{-- Register Card --}}
            <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6 shadow-2xl shadow-black/20 sm:p-8">

                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    {{-- Name --}}
                    <div>
                        <label
                            for="name"
                            class="mb-2 block text-sm font-medium text-slate-200"
                        >
                            Name
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Your name"
                            class="block w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-blue-500/60 focus:ring-2 focus:ring-blue-500/20"
                        >

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />
                    </div>


                    {{-- Email --}}
                    <div class="mt-5">

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
                            autocomplete="username"
                            placeholder="you@example.com"
                            class="block w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-blue-500/60 focus:ring-2 focus:ring-blue-500/20"
                        >

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Password --}}
                    <div class="mt-5">

                        <label
                            for="password"
                            class="mb-2 block text-sm font-medium text-slate-200"
                        >
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="block w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-blue-500/60 focus:ring-2 focus:ring-blue-500/20"
                        >

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Confirm Password --}}
                    <div class="mt-5">

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-medium text-slate-200"
                        >
                            Confirm Password
                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="block w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-blue-500/60 focus:ring-2 focus:ring-blue-500/20"
                        >

                        <x-input-error
                            :messages="$errors->get('password_confirmation')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Register Button --}}
                    <button
                        type="submit"
                        class="mt-7 flex w-full items-center justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40"
                    >
                        Create account
                    </button>

                </form>


                {{-- Login --}}
                <div class="my-6 flex items-center gap-4">

                    <div class="h-px flex-1 bg-white/10"></div>

                    <span class="text-xs text-slate-500">
                        OR
                    </span>

                    <div class="h-px flex-1 bg-white/10"></div>

                </div>

                <div class="text-center">

                    <p class="text-sm text-slate-400">
                        Already have an account?
                    </p>

                    <a
                        href="{{ route('login') }}"
                        class="mt-3 inline-flex w-full items-center justify-center rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-white transition hover:border-blue-500/30 hover:bg-white/10"
                    >
                        Log in
                    </a>

                </div>

            </div>


            {{-- Back --}}
            <div class="mt-6 text-center">

                <a
                    href="{{ route('landing') }}"
                    class="text-sm text-slate-500 transition hover:text-slate-300"
                >
                    ← Back to OussMarket
                </a>

            </div>

        </div>

    </div>

</x-guest-layout>