<x-app-layout>

    <div class="min-h-screen bg-[#020617] text-white">

        {{-- Breadcrumb --}}
        <div class="pt-6">
            <nav aria-label="Breadcrumb">
                <ol role="list"
                    class="mx-auto flex max-w-2xl items-center space-x-2 px-4
                           sm:px-6 lg:max-w-7xl lg:px-8">
                    <li>
                        <div class="flex items-center">
                            <a href="{{ route('product.index') }}"
                                class="mr-2 text-sm font-medium text-slate-400
                                       transition hover:text-white">
                                Products
                            </a>

                            <svg viewBox="0 0 16 20" width="16" height="20" fill="currentColor" aria-hidden="true"
                                class="h-5 w-4 text-slate-600">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                            </svg>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <a href="#"
                                class="mr-2 text-sm font-medium text-slate-400
                                       transition hover:text-white">
                                {{ $product->category->name }}
                            </a>

                            <svg viewBox="0 0 16 20" width="16" height="20" fill="currentColor"
                                aria-hidden="true" class="h-5 w-4 text-slate-600">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                            </svg>
                        </div>
                    </li>

                    <li class="text-sm">
                        <a href="#" aria-current="page" class="font-medium text-slate-500">
                            {{ $product->name }}
                        </a>
                    </li>
                </ol>
            </nav>
        </div>


        {{-- Product --}}
        <div
            class="mx-auto mt-6 max-w-2xl px-4
                   sm:px-6
                   lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-8 lg:px-8">

            {{-- Product Image --}}
            <div
                class="flex aspect-square items-center justify-center
                       overflow-hidden rounded-2xl
                       border border-white/10
                       bg-[#0f172a]
                       lg:col-span-2">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="h-full w-full object-contain p-10
                           transition duration-500
                           hover:scale-105">
            </div>


            {{-- Product Info --}}
            <div class="mt-8 lg:mt-0">

                <div class="border-b border-white/10 pb-6">

                    <p
                        class="text-sm font-semibold uppercase
                               tracking-widest text-blue-400">
                        {{ $product->category->name }}
                    </p>

                    <h1 class="mt-3 text-3xl font-bold tracking-tight
                               text-white">
                        {{ $product->name }}
                    </h1>

                    <p class="mt-5 text-3xl font-bold text-blue-400">
                        {{ $product->price }} DA
                    </p>

                </div>


                {{-- Reviews --}}
                <div class="mt-6">

                    <div class="flex items-center">

                        <div class="flex items-center">

                            {{-- Star 1 --}}
                            <svg viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0 text-blue-500">
                                <path
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>

                            {{-- Star 2 --}}
                            <svg viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0 text-blue-500">
                                <path
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>

                            {{-- Star 3 --}}
                            <svg viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0 text-blue-500">
                                <path
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637c-.194-.813.691-1.456 1.405-1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637-3.62-3.102c-.635-.544-.297-1.584.536-1.65l4.752-.382-1.831-4.401Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>

                            {{-- Star 4 --}}
                            <svg viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0 text-blue-500">
                                <path
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>

                            {{-- Star 5 --}}
                            <svg viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0 text-slate-700">
                                <path
                                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c-.635-.544-.297-1.584.536-1.65l4.752-.382-1.831-4.401Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>

                        </div>

                        <p class="sr-only">
                            4 out of 5 stars
                        </p>

                        <a href="#"
                            class="ml-3 text-sm font-medium text-blue-400
                                   transition hover:text-blue-300">
                            117 reviews
                        </a>

                    </div>

                </div>


                {{-- Options --}}
                <form class="mt-10">

                    {{-- Color --}}
                    <div>

                        <h3 class="text-sm font-medium text-white">
                            Color
                        </h3>

                        <fieldset aria-label="Choose a color" class="mt-4">

                            <div class="flex items-center gap-x-3">

                                <div
                                    class="flex rounded-full
                                           outline -outline-offset-1
                                           outline-white/20">
                                    <input type="radio" name="color" value="white" checked aria-label="White"
                                        class="size-8 appearance-none
                                               rounded-full bg-white
                                               forced-color-adjust-none
                                               checked:outline-2
                                               checked:outline-offset-2
                                               checked:outline-blue-500
                                               focus-visible:outline-3
                                               focus-visible:outline-offset-3">
                                </div>

                                <div
                                    class="flex rounded-full
                                           outline -outline-offset-1
                                           outline-white/20">
                                    <input type="radio" name="color" value="gray" aria-label="Gray"
                                        class="size-8 appearance-none
                                               rounded-full bg-gray-400
                                               forced-color-adjust-none
                                               checked:outline-2
                                               checked:outline-offset-2
                                               checked:outline-blue-500
                                               focus-visible:outline-3
                                               focus-visible:outline-offset-3">
                                </div>

                                <div
                                    class="flex rounded-full
                                           outline -outline-offset-1
                                           outline-white/20">
                                    <input type="radio" name="color" value="black" aria-label="Black"
                                        class="size-8 appearance-none
                                               rounded-full bg-gray-900
                                               forced-color-adjust-none
                                               checked:outline-2
                                               checked:outline-offset-2
                                               checked:outline-blue-500
                                               focus-visible:outline-3
                                               focus-visible:outline-offset-3">
                                </div>

                            </div>

                        </fieldset>

                    </div>


                    {{-- Add To Cart --}}
                    <button type="submit"
                        class="mt-10 flex w-full items-center
                               justify-center rounded-xl
                               bg-blue-600 px-8 py-3.5
                               text-base font-semibold text-white
                               shadow-lg shadow-blue-600/20
                               transition duration-200
                               hover:bg-blue-500
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-500/40">
                        Add To Cart
                    </button>

                </form>

            </div>

        </div>


        {{-- Description --}}
        <div class="mx-auto max-w-7xl px-4 py-16
                   sm:px-6
                   lg:px-8">

            <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">

                {{-- Description --}}
                <div class="lg:col-span-2">

                    <div class="rounded-2xl border border-white/10
                               bg-[#0f172a] p-8">

                        <h2 class="text-xl font-semibold text-white">
                            Description
                        </h2>

                        <p class="mt-5 leading-7 text-slate-300">
                            {{ $product->description }}
                        </p>

                    </div>

                </div>


                {{-- Details --}}
                <div>

                    <div class="rounded-2xl border border-white/10
                               bg-[#0f172a] p-8">

                        <h2 class="text-xl font-semibold text-white">
                            Details
                        </h2>

                        <div class="mt-5">

                            <p class="text-sm leading-6 text-slate-400">
                                The 6-Pack includes two black, two white,
                                and two heather gray Basic Tees. Sign up
                                for our subscription service and be the
                                first to get new, exciting colors.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
