<x-admin-layout>

    <main class="flex-1 overflow-y-auto bg-[#020617] p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">

            <div>
                <h1 class="text-2xl font-bold text-white">
                    Create Product
                </h1>

                <p class="text-sm text-slate-400 mt-1">
                    Add a new product to your catalog
                </p>
            </div>

            <a href="{{ route('admin.products') }}"
               class="border border-white/10 text-slate-300 hover:bg-white/5 px-4 py-2.5 rounded-xl text-sm font-medium transition flex items-center gap-2">

                <i class="fa-solid fa-arrow-left"></i>

                Back to Products

            </a>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-500/20 bg-red-500/10 p-4 text-red-400">

                <div class="flex items-center gap-2 mb-2 font-semibold">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Please fix the following errors:
                </div>

                <ul class="list-disc list-inside text-sm space-y-1">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Form --}}
        <form
            method="POST"
            action="{{ route('product.store') }}"
            enctype="multipart/form-data"
            class="space-y-6"
        >

            @csrf


            {{-- Basic Information --}}
            <div class="bg-[#0f172a] border border-white/10 rounded-2xl p-6">

                <div class="mb-6">

                    <h2 class="text-lg font-semibold text-white">
                        Product Information
                    </h2>

                    <p class="text-sm text-slate-400 mt-1">
                        Enter the basic information about your product.
                    </p>

                </div>


                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


                    {{-- Name --}}
                    <div class="lg:col-span-2">

                        <label
                            for="name"
                            class="block text-sm font-medium text-slate-300 mb-2"
                        >
                            Product Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter product name"
                            class="block w-full rounded-xl bg-[#020617] border border-white/10 text-white placeholder-slate-500 px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                        >

                    </div>


                    {{-- Description --}}
                    <div class="lg:col-span-2">

                        <label
                            for="description"
                            class="block text-sm font-medium text-slate-300 mb-2"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            placeholder="Describe your product..."
                            class="block w-full rounded-xl bg-[#020617] border border-white/10 text-white placeholder-slate-500 px-4 py-3 resize-none focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                        >{{ old('description') }}</textarea>

                    </div>


                    {{-- Category --}}
                    <div>

                        <label
                            for="category_id"
                            class="block text-sm font-medium text-slate-300 mb-2"
                        >
                            Category
                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                            class="block w-full rounded-xl bg-[#020617] border border-white/10 text-slate-300 px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                        >

                            <option value="" class="bg-[#0f172a]">
                                Choose a category
                            </option>

                            @foreach ($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)
                                    class="bg-[#0f172a]"
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Price --}}
                    <div>

                        <label
                            for="price"
                            class="block text-sm font-medium text-slate-300 mb-2"
                        >
                            Price
                        </label>

                        <div class="relative">

                            <input
                                id="price"
                                type="number"
                                name="price"
                                value="{{ old('price') }}"
                                placeholder="0.00"
                                step="0.01"
                                min="0"
                                class="block w-full rounded-xl bg-[#020617] border border-white/10 text-white placeholder-slate-500 px-4 py-3 pr-14 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                            >

                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm text-slate-500">
                                DA
                            </span>

                        </div>

                    </div>


                    {{-- Stock --}}
                    <div>

                        <label
                            for="stock"
                            class="block text-sm font-medium text-slate-300 mb-2"
                        >
                            Stock Quantity
                        </label>

                        <input
                            id="stock"
                            name="stock"
                            type="number"
                            value="{{ old('stock', 1) }}"
                            min="0"
                            class="block w-full rounded-xl bg-[#020617] border border-white/10 text-white px-4 py-3 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                        >

                    </div>


                    {{-- Sale Price --}}
                    <div>

                        <label
                            for="saleprice"
                            class="block text-sm font-medium text-slate-300 mb-2"
                        >
                            Sale Price
                            <span class="text-slate-500">(Optional)</span>
                        </label>

                        <div class="relative">

                            <input
                                id="saleprice"
                                type="number"
                                name="saleprice"
                                value="{{ old('saleprice') }}"
                                placeholder="0.00"
                                step="0.01"
                                min="0"
                                class="block w-full rounded-xl bg-[#020617] border border-white/10 text-white placeholder-slate-500 px-4 py-3 pr-14 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                            >

                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm text-slate-500">
                                DA
                            </span>

                        </div>

                    </div>


                    {{-- Image --}}
                    <div class="lg:col-span-2">

                        <label
                            for="image"
                            class="block text-sm font-medium text-slate-300 mb-2"
                        >
                            Product Image
                        </label>

                        <div class="border border-dashed border-white/10 rounded-xl bg-[#020617] p-6">

                            <div class="flex flex-col items-center justify-center text-center">

                                <div class="w-14 h-14 rounded-xl bg-[#0f172a] border border-white/10 flex items-center justify-center mb-3">

                                    <i class="fa-solid fa-cloud-arrow-up text-xl text-slate-500"></i>

                                </div>

                                <p class="text-sm text-slate-300">
                                    Upload product image
                                </p>

                                <p class="text-xs text-slate-500 mt-1 mb-4">
                                    PNG, JPG, JPEG, WEBP up to 2MB
                                </p>

                                <label
                                    for="image"
                                    class="cursor-pointer bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-xl text-sm font-medium transition"
                                >
                                    Choose Image
                                </label>

                                <input
                                    id="image"
                                    name="image"
                                    type="file"
                                    accept="image/png,image/jpeg,image/jpg,image/webp"
                                    class="hidden"
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex flex-col-reverse sm:flex-row justify-end gap-3">

                <a
                    href="{{ route('admin.products') }}"
                    class="px-5 py-2.5 rounded-xl border border-white/10 text-slate-300 hover:bg-white/5 text-sm font-medium transition text-center"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold transition flex items-center justify-center gap-2"
                >

                    <i class="fa-solid fa-plus"></i>

                    Create Product

                </button>

            </div>

        </form>

    </main>

</x-admin-layout>