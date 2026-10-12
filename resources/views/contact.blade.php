<x-app-layout>

    {{-- Contact Section --}}
    <div class="min-h-[calc(100vh-5rem)] bg-[#020617]">

        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">

            {{-- Page Header --}}
            <div class="mx-auto mb-12 max-w-2xl text-center">

                <span
                    class="inline-flex items-center rounded-full
                           border border-blue-500/20
                           bg-blue-500/10 px-3 py-1
                           text-sm font-medium text-blue-400"
                >
                    Contact Us
                </span>

                <h1
                    class="mt-4 text-3xl font-bold tracking-tight
                           text-white sm:text-4xl"
                >
                    Get in touch with us
                </h1>

                <p class="mt-4 text-slate-400">
                    Have a question about our products or need help?
                    Send us a message and we'll get back to you.
                </p>

            </div>


            {{-- Main Grid --}}
            <div class="grid items-start gap-10 lg:grid-cols-3">


                {{-- Information --}}
                <div class="lg:col-span-1">

                    <div
                        class="rounded-2xl border border-white/10
                               bg-[#0f172a] p-6 sm:p-8"
                    >

                        <h2 class="text-xl font-semibold text-white">
                            Let's talk
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-slate-400">
                            Whether you have a question about a product,
                            your order, or anything else, we're here to help.
                        </p>


                        {{-- Email --}}
                        <div class="mt-8 flex items-start gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center
                                       justify-center rounded-xl
                                       bg-blue-600/10 text-blue-400"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>

                            <div>

                                <p class="text-sm font-medium text-white">
                                    Email
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    support@oussmarket.com
                                </p>

                            </div>

                        </div>


                        {{-- Support --}}
                        <div class="mt-6 flex items-start gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center
                                       justify-center rounded-xl
                                       bg-blue-600/10 text-blue-400"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M18 10c0 3.866-3.582 7-8 7a9.863 9.863 0 01-4-.8L3 17l1.2-3.2A6.97 6.97 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 19c3.314 0 6-2.239 6-5a5.32 5.32 0 00-1.5-3.6"
                                    />
                                </svg>
                            </div>

                            <div>

                                <p class="text-sm font-medium text-white">
                                    Support
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    We're here to help you.
                                </p>

                            </div>

                        </div>


                        {{-- Location --}}
                        <div class="mt-6 flex items-start gap-4">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center
                                       justify-center rounded-xl
                                       bg-blue-600/10 text-blue-400"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 21s7-4.35 7-10a7 7 0 10-14 0c0 5.65 7 10 7 10z"
                                    />
                                    <circle
                                        cx="12"
                                        cy="11"
                                        r="2.5"
                                    />
                                </svg>
                            </div>

                            <div>

                                <p class="text-sm font-medium text-white">
                                    Location
                                </p>

                                <p class="mt-1 text-sm text-slate-400">
                                    Algeria
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Contact Form --}}
                <div class="lg:col-span-2">

                    <div
                        class="rounded-2xl border border-white/10
                               bg-[#0f172a] p-6 sm:p-8 lg:p-10"
                    >

                        <h2 class="text-xl font-semibold text-white">
                            Send us a message
                        </h2>

                        <p class="mt-2 text-sm text-slate-400">
                            Fill in the form below and we'll contact you.
                        </p>


                        <form
                            method="POST"
                            action="#"
                            class="mt-8"
                        >

                            @csrf

                            <div class="grid gap-6 sm:grid-cols-2">

                                {{-- First Name --}}
                                <div>

                                    <label
                                        for="first_name"
                                        class="mb-2 block text-sm
                                               font-medium text-slate-300"
                                    >
                                        First Name
                                    </label>

                                    <input
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        required
                                        class="block w-full rounded-xl
                                               border border-white/10
                                               bg-[#020617] px-4 py-3
                                               text-sm text-white
                                               placeholder:text-slate-600
                                               outline-none transition
                                               focus:border-blue-500
                                               focus:ring-2
                                               focus:ring-blue-500/20"
                                        placeholder="Your first name"
                                    >

                                </div>


                                {{-- Last Name --}}
                                <div>

                                    <label
                                        for="last_name"
                                        class="mb-2 block text-sm
                                               font-medium text-slate-300"
                                    >
                                        Last Name
                                    </label>

                                    <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        required
                                        class="block w-full rounded-xl
                                               border border-white/10
                                               bg-[#020617] px-4 py-3
                                               text-sm text-white
                                               placeholder:text-slate-600
                                               outline-none transition
                                               focus:border-blue-500
                                               focus:ring-2
                                               focus:ring-blue-500/20"
                                        placeholder="Your last name"
                                    >

                                </div>


                                {{-- Email --}}
                                <div class="sm:col-span-2">

                                    <label
                                        for="email"
                                        class="mb-2 block text-sm
                                               font-medium text-slate-300"
                                    >
                                        Email
                                    </label>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        autocomplete="email"
                                        required
                                        class="block w-full rounded-xl
                                               border border-white/10
                                               bg-[#020617] px-4 py-3
                                               text-sm text-white
                                               placeholder:text-slate-600
                                               outline-none transition
                                               focus:border-blue-500
                                               focus:ring-2
                                               focus:ring-blue-500/20"
                                        placeholder="you@example.com"
                                    >

                                </div>


                                {{-- Subject --}}
                                <div class="sm:col-span-2">

                                    <label
                                        for="subject"
                                        class="mb-2 block text-sm
                                               font-medium text-slate-300"
                                    >
                                        Subject
                                    </label>

                                    <input
                                        type="text"
                                        id="subject"
                                        name="subject"
                                        required
                                        class="block w-full rounded-xl
                                               border border-white/10
                                               bg-[#020617] px-4 py-3
                                               text-sm text-white
                                               placeholder:text-slate-600
                                               outline-none transition
                                               focus:border-blue-500
                                               focus:ring-2
                                               focus:ring-blue-500/20"
                                        placeholder="How can we help?"
                                    >

                                </div>


                                {{-- Message --}}
                                <div class="sm:col-span-2">

                                    <label
                                        for="message"
                                        class="mb-2 block text-sm
                                               font-medium text-slate-300"
                                    >
                                        Message
                                    </label>

                                    <textarea
                                        id="message"
                                        name="message"
                                        rows="6"
                                        required
                                        class="block w-full resize-none
                                               rounded-xl border
                                               border-white/10
                                               bg-[#020617] px-4 py-3
                                               text-sm text-white
                                               placeholder:text-slate-600
                                               outline-none transition
                                               focus:border-blue-500
                                               focus:ring-2
                                               focus:ring-blue-500/20"
                                        placeholder="Write your message..."
                                    ></textarea>

                                </div>

                            </div>


                            {{-- Submit --}}
                            <div class="mt-8">

                                <button
                                    type="submit"
                                    class="inline-flex w-full items-center
                                           justify-center gap-2 rounded-xl
                                           bg-blue-600 px-5 py-3
                                           text-sm font-semibold text-white
                                           shadow-lg shadow-blue-600/10
                                           transition hover:bg-blue-500
                                           focus:outline-none
                                           focus:ring-2
                                           focus:ring-blue-500/40
                                           sm:w-auto"
                                >

                                    Send Message

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
                                            d="M5 12h14m-6-6 6 6-6 6"
                                        />
                                    </svg>

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>