<x-app-layout>

    <div @class(['min-h-screen', 'bg-slate-950', 'text-white'])>
        <!-- Create button -->
        {{-- <div @class(['mx-auto', 'max-w-7xl', 'px-4', 'pt-6', 'sm:px-6', 'lg:px-8'])>
            <a
                href="{{ route('product.create') }}"
                class="inline-flex items-center gap-x-2 rounded-lg
                       bg-indigo-600 px-4 py-3 text-sm font-medium text-white
                       hover:bg-indigo-700 transition"
            >
                Create product
            </a>
        </div> --}}
        {{-- Featured Products --}}
        <section @class(['border-b', 'border-white/10', 'bg-[#020617]'])>
            <div @class([
                'mx-auto',
                'max-w-7xl',
                'px-4',
                'py-10',
                'sm:px-6',
                'lg:px-8',
            ])>

                <div x-data="{
                    current: 0,
                    total: {{ $Cproducts->count() }},
                
                    next() {
                        if (this.total > 0) {
                            this.current = (this.current + 1) % this.total
                        }
                    },
                
                    prev() {
                        if (this.total > 0) {
                            this.current =
                                (this.current - 1 + this.total) % this.total
                        }
                    }
                }" x-init="if (total > 1) setInterval(() => next(), 4000)"
                    class="relative overflow-hidden rounded-2xl border border-white/10
                        bg-gradient-to-r from-[#0f172a] to-[#111827]">

                    {{-- Slides --}}
                    <div @class(['flex', 'transition-transform', 'duration-700', 'ease-out']) :style="`transform: translateX(-${current * 100}%)`">

                        @foreach ($Cproducts as $Cproduct)
                            <div @class(['w-full', 'shrink-0'])>

                                <a href="{{ route('product.show', $Cproduct) }}"
                                    class="grid min-h-[320px] grid-cols-1
                                        items-center md:grid-cols-2">

                                    {{-- Product image --}}
                                    <div
                                        class="flex h-[320px] items-center justify-center
                                                p-8 md:h-[360px]">
                                        <img src="{{ asset('storage/' . $Cproduct->image) }}" alt="{{ $Cproduct->name }}"
                                            class="h-full w-full object-contain
                                                transition duration-500
                                                hover:scale-105">
                                    </div>

                                    {{-- Product information --}}
                                    <div @class(['px-8', 'pb-10', 'md:px-12', 'md:pb-0'])>

                                        <span
                                            class="text-sm font-semibold uppercase
                                                tracking-widest text-blue-400">
                                            Featured Product
                                        </span>

                                        <h2
                                            class="mt-3 text-3xl font-bold text-white
                                                lg:text-4xl">
                                            {{ $Cproduct->name }}
                                        </h2>

                                        <p @class(['mt-4', 'text-xl', 'font-bold', 'text-blue-400'])>
                                            {{ $Cproduct->price }} DA
                                        </p>

                                        <span
                                            class="mt-6 inline-flex items-center gap-2
                                                rounded-lg bg-blue-600 px-5 py-3
                                                text-sm font-semibold text-white
                                                transition hover:bg-blue-500">
                                            View Product →
                                        </span>

                                    </div>

                                </a>

                            </div>
                        @endforeach

                    </div>


                    {{-- Previous --}}
                    <button @click="prev()" type="button"
                        class="absolute left-4 top-1/2 -translate-y-1/2
                            flex h-10 w-10 items-center justify-center
                            rounded-full border border-white/10
                            bg-black/40 text-white backdrop-blur
                            transition hover:bg-blue-600">
                        ←
                    </button>


                    {{-- Next --}}
                    <button @click="next()" type="button"
                        class="absolute right-4 top-1/2 -translate-y-1/2
                            flex h-10 w-10 items-center justify-center
                            rounded-full border border-white/10
                            bg-black/40 text-white backdrop-blur
                            transition hover:bg-blue-600">
                        →
                    </button>


                    {{-- Indicators --}}
                    <div class="absolute bottom-5 left-1/2 flex
                            -translate-x-1/2 gap-2">

                        @foreach ($Cproducts as $index => $Cproduct)
                            <button @click="current = {{ $index }}" type="button" @class(['h-2', 'rounded-full', 'transition-all'])
                                :class="current === {{ $index }} ?
                                    'w-6 bg-blue-500' :
                                    'w-2 bg-white/30'"></button>
                        @endforeach

                    </div>

                </div>

            </div>
        </section>
        {{-- PRODUCTS AREA --}}
        <div @class([
            'mx-auto',
            'max-w-7xl',
            'px-4',
            'py-12',
            'sm:px-6',
            'lg:px-8',
        ])>

            <div @class(['grid', 'grid-cols-1', 'gap-8', 'lg:grid-cols-4'])>

                {{-- SIDEBAR --}}
                <aside @class(['lg:col-span-1'])>

                    <div @class([
                        'sticky',
                        'top-24',
                        'rounded-2xl',
                        'border',
                        'border-white/10',
                        'bg-[#0f172a]',
                        'p-6',
                    ])>

                        <h2 @class(['mb-6', 'text-lg', 'font-semibold', 'text-white'])>
                            Filters
                        </h2>

                        <form method="GET" action="{{ route('product.index') }}">

                            {{-- Category --}}
                            <div>

                                <h3 @class(['mb-3', 'font-medium', 'text-white'])>
                                    Category
                                </h3>

                                <div @class(['space-y-3'])>

                                    {{-- All categories --}}
                                    <label @class([
                                        'flex',
                                        'cursor-pointer',
                                        'items-center',
                                        'gap-3',
                                        'text-sm',
                                        'text-slate-300',
                                    ])>

                                        <input type="radio" name="category_id" value=""
                                            @checked(!request('category_id'))
                                            class="h-4 w-4 border-white/20 bg-slate-950
                                           text-blue-600
                                           focus:ring-2 focus:ring-blue-500/30">

                                        <span>
                                            All categories
                                        </span>

                                    </label>


                                    {{-- Categories --}}
                                    @foreach ($categories as $category)
                                        <label @class([
                                            'flex',
                                            'cursor-pointer',
                                            'items-center',
                                            'gap-3',
                                            'text-sm',
                                            'text-slate-300',
                                        ])>

                                            <input type="radio" name="category_id" value="{{ $category->id }}"
                                                @checked(request('category_id') == $category->id)
                                                class="h-4 w-4 border-white/20 bg-slate-950
                                               text-blue-600
                                               focus:ring-2 focus:ring-blue-500/30">

                                            <span>
                                                {{ $category->name }}
                                            </span>

                                        </label>
                                    @endforeach

                                </div>

                            </div>


                            {{-- Price --}}
                            <div @class(['mt-8'])>

                                <h3 @class(['mb-3', 'font-medium', 'text-white'])>
                                    Price
                                </h3>

                                <div @class(['space-y-4'])>

                                    {{-- Minimum --}}
                                    <div>

                                        <label for="min_price" @class(['text-sm', 'text-slate-400'])>
                                            Minimum
                                        </label>

                                        <input id="min_price" type="number" name="min_price"
                                            value="{{ request('min_price') }}" placeholder="0" min="0"
                                            class="mt-1 block w-full rounded-lg border
                                           border-white/10 bg-[#020617]
                                           px-3 py-2.5 text-sm text-white
                                           placeholder:text-slate-600
                                           focus:border-blue-500
                                           focus:outline-none
                                           focus:ring-2 focus:ring-blue-500/20">

                                    </div>


                                    {{-- Maximum --}}
                                    <div>

                                        <label for="max_price" @class(['text-sm', 'text-slate-400'])>
                                            Maximum
                                        </label>

                                        <input id="max_price" type="number" name="max_price"
                                            value="{{ request('max_price') }}" placeholder="100000" min="0"
                                            class="mt-1 block w-full rounded-lg border
                                           border-white/10 bg-[#020617]
                                           px-3 py-2.5 text-sm text-white
                                           placeholder:text-slate-600
                                           focus:border-blue-500
                                           focus:outline-none
                                           focus:ring-2 focus:ring-blue-500/20">

                                    </div>

                                </div>

                            </div>


                            {{-- Apply Filters --}}
                            <button type="submit"
                                class="mt-8 w-full rounded-lg bg-blue-600
                               px-4 py-3 text-sm font-semibold text-white
                               shadow-lg shadow-blue-600/10
                               transition duration-200
                               hover:bg-blue-500
                               focus:outline-none
                               focus:ring-2 focus:ring-blue-500/40">
                                Apply Filters
                            </button>


                            {{-- Clear Filters --}}
                            <a href="{{ route('product.index') }}"
                                class="mt-3 block text-center text-sm text-slate-400
                               transition hover:text-white">
                                Clear Filters
                            </a>

                        </form>

                    </div>

                </aside>


                {{-- PRODUCTS --}}
                <main @class(['lg:col-span-3'])>

                    {{-- Header --}}
                    <div @class(['mb-8', 'flex', 'items-center', 'justify-between'])>

                        <div>
                            <h2 @class(['text-2xl', 'font-bold', 'tracking-tight', 'text-white'])>
                                Products
                            </h2>

                            <p @class(['mt-1', 'text-sm', 'text-slate-400'])>
                                Find the technology you need
                            </p>
                        </div>

                        <span @class(['text-sm', 'text-slate-400'])>
                            {{ $products->count() }} products
                        </span>

                    </div>


                    {{-- Product Grid --}}
                    <div @class([
                        'grid',
                        'grid-cols-1',
                        'gap-x-6',
                        'gap-y-10',
                        'sm:grid-cols-2',
                        'xl:grid-cols-3',
                    ])>

                        @forelse ($products as $product)
                            <a href="{{ route('product.show', $product) }}" @class(['group'])>

                                {{-- Image --}}
                                <div
                                    class="flex aspect-square items-center justify-center
                                   overflow-hidden rounded-2xl
                                   border border-white/10
                                   bg-[#0f172a]
                                   transition duration-300
                                   group-hover:border-blue-500/40
                                   group-hover:shadow-xl
                                   group-hover:shadow-blue-500/10">

                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="h-full w-full object-contain p-6
                                       transition duration-300
                                       group-hover:scale-105">

                                </div>


                                {{-- Information --}}
                                <div @class(['mt-4', 'px-1'])>

                                    <h3 @class(['text-sm', 'font-medium', 'text-white'])>
                                        {{ $product->name }}
                                    </h3>

                                    <p @class(['mt-1', 'text-lg', 'font-bold', 'text-blue-400'])>
                                        {{ $product->price }} DA
                                    </p>

                                    <p @class(['mt-1', 'text-sm', 'text-slate-400'])>
                                        Stock: {{ $product->stock }}
                                    </p>

                                </div>

                            </a>

                        @empty

                            <div @class(['col-span-full', 'py-20', 'text-center'])>

                                <h3 @class(['text-lg', 'font-semibold', 'text-white'])>
                                    No products found
                                </h3>

                                <p @class(['mt-2', 'text-sm', 'text-slate-400'])>
                                    Try changing your filters.
                                </p>

                            </div>
                        @endforelse

                    </div>

                </main>

            </div>

        </div>

</x-app-layout>
