<x-admin-layout>

    <main class="flex-1 overflow-y-auto bg-[#020617] p-6 lg:p-8">

        {{-- ========================================================= --}}
        {{-- Page Header --}}
        {{-- ========================================================= --}}

        <div class="mb-8 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">

            <div>
                <h1 class="text-2xl font-bold text-white">
                    Products
                </h1>

                <p class="mt-1 text-sm text-slate-400">
                    Manage your product catalog
                </p>

            </div>


            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">

                {{-- Delete Selected --}}
                <button type="button" id="bulkDeletedBtn" disabled
                    class="inline-flex w-full cursor-not-allowed items-center justify-center gap-2 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white opacity-50 shadow-sm transition hover:bg-red-500 sm:w-auto">
                    <i class="fa-solid fa-trash"></i>

                    Delete selected
                    (<span id="selectedCount">0</span>)
                </button>


                {{-- Add Product --}}
                <a href="{{ route('admin.product.add') }}"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-blue-500 sm:w-auto">
                    <i class="fa-solid fa-plus"></i>
                    Add New Product
                </a>
                <button onclick="printDiv('pritableArea')"
                    class="border border-gray-300 text-gray-600 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-print"></i> Print
                </button>
                <a href="{{ route('admin.product.export') }}"
                    class="border border-gray-300 text-gray-600 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-file-export"></i> Export
                </a>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- Success Message --}}
        {{-- ========================================================= --}}

        @if (session('success'))
            <div
                class="mb-6 flex items-center gap-3 rounded-xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm text-green-400">
                <i class="fa-solid fa-circle-check"></i>

                <span>
                    {{ session('success') }}
                </span>
            </div>
        @endif



        {{-- ========================================================= --}}
        {{-- Filters --}}
        {{-- ========================================================= --}}

        <div class="mb-6 rounded-2xl border border-white/10 bg-[#0f172a] p-5">

            <form action="{{ route('admin.products') }}" method="GET"
                class="flex flex-col justify-between gap-1 lg:flex-row" id="filterForm">

                <div class="flex w-full flex-col gap-1 md:flex-row lg:w-auto">

                    {{-- Search --}}
                    <div class="relative w-full md:w-72">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fa-solid fa-magnifying-glass text-slate-500"></i>
                        </span>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search product name..."
                            onkeypress="if(event.key==='Enter') this.form.submit(); "
                            class="w-full rounded-xl border border-white/10 bg-[#020617] py-2.5 pl-10 pr-4 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                    </div>


                    {{-- Category --}}
                    <select name="category" onchange="this.form.submit()"
                        class="w-full rounded-xl border border-white/10 bg-[#020617] px-3 py-2.5 text-sm text-slate-300 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600 md:w-52">

                        <option value="">
                            All Categories
                        </option>

                        @foreach ($categories ?? [] as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                    {{-- Brand --}}
                    <select name="brand" onchange="this.form.submit()"
                        class="w-full rounded-xl border border-white/10 bg-[#020617] px-3 py-2.5 text-sm text-slate-300 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600 md:w-52">

                        <option value="">
                            All Brand
                        </option>

                        @foreach ($brands ?? [] as $brand)
                            <option value="{{ $brand->id }}" @selected(request('category') == $brand->id)>
                                {{ $brand->name }}
                            </option>
                        @endforeach

                    </select>
                    @if (request()->hasAny(['search', 'category', 'brand']))
                        <a href="{{ route('admin.products') }}"
                            class="text-gray-500 hover:underline text-sm font-medium self-center">
                            Clear Filter
                        </a>
                    @endif


                    {{-- Stock --}}
                    <select name="stock"
                        class="w-full rounded-xl border border-white/10 bg-[#020617] px-3 py-2.5 text-sm text-slate-300 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600 md:w-44">

                        <option value="">
                            All Stock
                        </option>

                        <option value="in" @selected(request('stock') === 'in')>
                            In Stock
                        </option>

                        <option value="out" @selected(request('stock') === 'out')>
                            Out of Stock
                        </option>

                    </select>

                </div>


                {{-- Filter Button --}}
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-500">
                    <i class="fa-solid fa-filter"></i>
                    Filter
                </button>

            </form>

        </div>



        {{-- ========================================================= --}}
        {{-- Products Table --}}
        {{-- ========================================================= --}}

        <div id="pritableArea" class="overflow-hidden rounded-2xl border border-white/10 bg-[#0f172a]">

            <form id="bulkActionForm" action="{{ route('admin.products.bulkDestroy') }}" method="POST">

                @csrf
                @method('DELETE')


                <div class="overflow-x-auto">

                    <table class="w-full whitespace-nowrap text-left">

                        <thead class="bg-white/[0.02] text-xs font-semibold uppercase text-slate-400">

                            <tr>

                                {{-- Select --}}
                                <th class="px-6 py-4">

                                    <input type="checkbox" id="selectAll"
                                        class="rounded border-white/10 bg-[#020617] text-blue-600 focus:ring-blue-600">

                                </th>


                                {{-- Product --}}
                                <th class="px-6 py-4">
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center gap-1 hover:text-primary transition">
                                        Product<i
                                            class="fa-solid {{ request('sort_by') !== 'name'
                                                ? 'fa-sort'
                                                : (request('sort_order') === 'asc'
                                                    ? 'fa-sort-up'
                                                    : 'fa-sort-down') }} ml-1"></i>
                                    </a>
                                </th>


                                {{-- SKU --}}
                                <th class="px-6 py-4">
                                    SKU
                                </th>


                                {{-- Category --}}
                                <th class="px-6 py-4">
                                    Category
                                </th>


                                {{-- Price --}}
                                <th class="px-6 py-4">

                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'price', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center gap-1 hover:text-primary transition">
                                        Price <i
                                            class="fa-solid {{ request('sort_by') !== 'price'
                                                ? 'fa-sort'
                                                : (request('sort_order') === 'asc'
                                                    ? 'fa-sort-up'
                                                    : 'fa-sort-down') }} ml-1"></i>
                                    </a>
                                </th>


                                {{-- Stock --}}
                                <th class="px-6 py-4">

                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'stock', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center gap-1 hover:text-primary transition">
                                        Stock <i
                                            class="fa-solid {{ request('sort_by') !== 'stock'
                                                ? 'fa-sort'
                                                : (request('sort_order') === 'asc'
                                                    ? 'fa-sort-up'
                                                    : 'fa-sort-down') }} ml-1"></i>

                                    </a>
                                </th>


                                {{-- Status --}}
                                <th class="px-6 py-4">
                                    Status
                                </th>


                                {{-- Actions --}}
                                <th class="px-6 py-4 text-right">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-white/5">


                            @forelse ($products as $product)
                                <tr class="transition hover:bg-white/[0.02]">


                                    {{-- ================================================= --}}
                                    {{-- Checkbox --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4">

                                        <input type="checkbox" name="ids[]" value="{{ $product->id }}"
                                            class="product-checkbox rounded border-white/10 bg-[#020617] text-blue-600 focus:ring-blue-600">

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- Product --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-[#020617]">

                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}" class="h-full w-full object-cover">
                                                @else
                                                    <i class="fa-solid fa-box text-slate-600"></i>
                                                @endif

                                            </div>


                                            <div>

                                                <p class="text-sm font-semibold text-white">
                                                    {{ $product->name }}
                                                </p>

                                                <p class="mt-1 text-xs text-slate-500">
                                                    ID: #PROD-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- SKU --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-sm text-slate-300">

                                        {{ $product->sku }}

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- Category --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-sm text-slate-300">

                                        {{ $product->category?->name ?? 'N/A' }}

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- Price --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-sm">

                                        @if ($product->sale_price)
                                            <div class="flex flex-col">

                                                <span class="text-xs text-slate-500 line-through">
                                                    {{ number_format($product->price, 2) }} DA
                                                </span>

                                                <span class="font-semibold text-white">
                                                    {{ number_format($product->sale_price, 2) }} DA
                                                </span>

                                            </div>
                                        @else
                                            <span class="font-semibold text-white">
                                                {{ number_format($product->price, 2) }} DA
                                            </span>
                                        @endif

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- Stock --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-sm text-slate-300">

                                        {{ $product->stock }}

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- Status --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4">

                                        @if ($product->stock > 0)
                                            <span
                                                class="rounded-full border border-green-500/20 bg-green-500/10 px-2.5 py-1 text-xs font-semibold text-green-400">
                                                In Stock
                                            </span>
                                        @else
                                            <span
                                                class="rounded-full border border-red-500/20 bg-red-500/10 px-2.5 py-1 text-xs font-semibold text-red-400">
                                                Out of Stock
                                            </span>
                                        @endif

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- Actions --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-right">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- Edit --}}
                                            <a href="{{ route('admin.product.edit', $product->id) }}"
                                                class="flex h-9 w-9 items-center justify-center rounded-xl text-blue-400 transition hover:bg-blue-500/10"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>


                                            {{-- Delete --}}
                                            <form action="{{ route('admin.product.destroy', $product->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this product?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="flex h-9 w-9 items-center justify-center rounded-xl text-red-400 transition hover:bg-red-500/10"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                {{-- ================================================= --}}
                                {{-- Empty State --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td colspan="8" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center justify-center">

                                            <div
                                                class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl border border-white/10 bg-[#020617]">
                                                <i class="fa-solid fa-boxes-stacked text-2xl text-slate-500"></i>
                                            </div>


                                            <h3 class="text-lg font-semibold text-white">
                                                No products found
                                            </h3>


                                            <p class="mt-1 text-sm text-slate-400">
                                                You haven't added any products to your store yet.
                                            </p>


                                            <a href="{{ route('admin.product.add') }}"
                                                class="mt-5 text-sm font-medium text-blue-400 transition hover:text-blue-300">
                                                Add your first product
                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </form>



            {{-- ========================================================= --}}
            {{-- Pagination --}}
            {{-- ========================================================= --}}

            {{-- @if ($products->hasPages())

                <div class="border-t border-white/5 px-6 py-4">

                    {{ $products->withQueryString()->links() }}

                </div>

            @endif --}}

        </div>

    </main>



    {{-- ============================================================= --}}
    {{-- JavaScript --}}
    {{-- ============================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const selectAll = document.getElementById('selectAll');
            const selectedCount = document.getElementById('selectedCount');
            const bulkDeletedBtn = document.getElementById('bulkDeletedBtn');
            const bulkActionForm = document.getElementById('bulkActionForm');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');


            /*
            |--------------------------------------------------------------------------
            | Update selected count
            |--------------------------------------------------------------------------
            */

            function updateSelectedCount() {

                const checked =
                    document.querySelectorAll('.product-checkbox:checked');

                const count = checked.length;

                selectedCount.textContent = count;


                if (count > 0) {

                    bulkDeletedBtn.disabled = false;

                    bulkDeletedBtn.classList.remove(
                        'opacity-50',
                        'cursor-not-allowed'
                    );

                } else {

                    bulkDeletedBtn.disabled = true;

                    bulkDeletedBtn.classList.add(
                        'opacity-50',
                        'cursor-not-allowed'
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | Update Select All state
                |--------------------------------------------------------------------------
                */

                if (productCheckboxes.length === 0) {

                    selectAll.checked = false;
                    selectAll.indeterminate = false;

                    return;

                }


                if (count === productCheckboxes.length) {

                    selectAll.checked = true;
                    selectAll.indeterminate = false;

                } else if (count > 0) {

                    selectAll.checked = false;
                    selectAll.indeterminate = true;

                } else {

                    selectAll.checked = false;
                    selectAll.indeterminate = false;

                }

            }



            /*
            |--------------------------------------------------------------------------
            | Select All
            |--------------------------------------------------------------------------
            */

            selectAll.addEventListener('change', function() {

                productCheckboxes.forEach(function(checkbox) {

                    checkbox.checked = selectAll.checked;

                });

                updateSelectedCount();

            });



            /*
            |--------------------------------------------------------------------------
            | Individual checkboxes
            |--------------------------------------------------------------------------
            */

            productCheckboxes.forEach(function(checkbox) {

                checkbox.addEventListener('change', function() {

                    updateSelectedCount();

                });

            });



            /*
            |--------------------------------------------------------------------------
            | Delete Selected
            |--------------------------------------------------------------------------
            */

            bulkDeletedBtn.addEventListener('click', function() {

                const checked =
                    document.querySelectorAll('.product-checkbox:checked');


                if (checked.length === 0) {

                    return;

                }


                const confirmed = confirm(
                    `Are you sure you want to delete ${checked.length} selected product(s)?`
                );


                if (!confirmed) {

                    return;

                }


                bulkActionForm.submit();

            });



            /*
            |--------------------------------------------------------------------------
            | Initial state
            |--------------------------------------------------------------------------
            */

            updateSelectedCount();

        });
    </script>
    <script>
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originaleContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originaleContents;
        }
    </script>

</x-admin-layout>
