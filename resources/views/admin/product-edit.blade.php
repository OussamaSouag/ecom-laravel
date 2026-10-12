<x-admin-layout>

    <div class="min-h-screen bg-[#020617] px-6 py-8 lg:px-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">
                    Edit Product
                </h1>

                <p class="mt-1 text-sm text-slate-400">
                    Update the information of this product.
                </p>
            </div>

            <a
                href="{{ route('admin.products') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-[#0f172a] px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white"
            >
                <i class="fa-solid fa-arrow-left"></i>
                Back to Products
            </a>
        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4">
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-circle-exclamation mt-0.5 text-red-400"></i>

                    <div>
                        <h3 class="font-medium text-red-400">
                            Please fix the following errors:
                        </h3>

                        <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif


        {{-- Form --}}
        <form
            action="{{ route('admin.product.update', $product->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')


            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

                {{-- ====================================================== --}}
                {{-- LEFT SIDE --}}
                {{-- ====================================================== --}}
                <div class="space-y-6 xl:col-span-2">


                    {{-- Basic Information --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-white">
                                Basic Information
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Update the basic information of your product.
                            </p>
                        </div>


                        {{-- Product Name --}}
                        <div class="mb-5">
                            <label
                                for="name"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Product Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                placeholder="Enter product name"
                                class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Description --}}
                        <div class="mb-5">
                            <label
                                for="description"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="6"
                                placeholder="Enter product description"
                                class="w-full resize-none rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                            >{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Short Description --}}
                        <div class="mb-5">
                            <label
                                for="short_description"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Short Description
                            </label>

                            <textarea
                                id="short_description"
                                name="short_description"
                                rows="3"
                                placeholder="Short product description"
                                class="w-full resize-none rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                            >{{ old('short_description', $product->short_description) }}</textarea>

                            @error('short_description')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Slug --}}
                        <div class="mb-5">
                            <label
                                for="slug"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                Slug
                            </label>

                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                value="{{ old('slug', $product->slug) }}"
                                placeholder="product-slug"
                                class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                            >

                            <p class="mt-2 text-xs text-slate-500">
                                Used in the product URL.
                            </p>

                            @error('slug')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- SKU --}}
                        <div>
                            <label
                                for="SKU"
                                class="mb-2 block text-sm font-medium text-slate-300"
                            >
                                SKU
                            </label>

                            <input
                                type="text"
                                id="SKU"
                                name="SKU"
                                value="{{ old('SKU  ', $product->SKU) }}"
                                placeholder="e.g. HAV-KB867-BLU"
                                class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                            >

                            <p class="mt-2 text-xs text-slate-500">
                                Unique identifier for inventory management.
                            </p>

                            @error('SKU')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>



                    {{-- Pricing & Inventory --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-white">
                                Pricing & Inventory
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Manage product pricing and stock.
                            </p>
                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                            {{-- Price --}}
                            <div>
                                <label
                                    for="price"
                                    class="mb-2 block text-sm font-medium text-slate-300"
                                >
                                    Price
                                </label>

                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-500">
                                        DA
                                    </span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="price"
                                        name="price"
                                        value="{{ old('price', $product->price) }}"
                                        placeholder="0.00"
                                        class="w-full rounded-xl border border-white/10 bg-[#020617] py-3 pl-12 pr-4 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                                    >
                                </div>

                                @error('price')
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Sale Price --}}
                            <div>
                                <label
                                    for="sale_price"
                                    class="mb-2 block text-sm font-medium text-slate-300"
                                >
                                    Sale Price
                                </label>

                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-500">
                                        DA
                                    </span>

                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="sale_price"
                                        name="sale_price"
                                        value="{{ old('sale_price', $product->sale_price) }}"
                                        placeholder="0.00"
                                        class="w-full rounded-xl border border-white/10 bg-[#020617] py-3 pl-12 pr-4 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                                    >
                                </div>

                                @error('sale_price')
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Stock --}}
                            <div>
                                <label
                                    for="stock"
                                    class="mb-2 block text-sm font-medium text-slate-300"
                                >
                                    Stock
                                </label>

                                <input
                                    type="number"
                                    min="0"
                                    id="stock"
                                    name="stock"
                                    value="{{ old('stock', $product->stock) }}"
                                    placeholder="0"
                                    class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                                >

                                @error('stock')
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                    </div>



                    {{-- Organization --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-6">
                            <h2 class="text-lg font-semibold text-white">
                                Organization
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Assign this product to a category and brand.
                            </p>
                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- Category --}}
                            <div>
                                <label
                                    for="category_id"
                                    class="mb-2 block text-sm font-medium text-slate-300"
                                >
                                    Category
                                </label>

                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                                >
                                    <option value="">
                                        Select category
                                    </option>

                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            @selected(old('category_id', $product->category_id) == $category->id)
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>


                            {{-- Brand --}}
                            <div>
                                <label
                                    for="brand_id"
                                    class="mb-2 block text-sm font-medium text-slate-300"
                                >
                                    Brand
                                </label>

                                <select
                                    id="brand_id"
                                    name="brand_id"
                                    class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                                >
                                    <option value="">
                                        Select brand
                                    </option>

                                    @foreach ($brands as $brand)
                                        <option
                                            value="{{ $brand->id }}"
                                            @selected(old('brand_id', $product->brand_id) == $brand->id)
                                        >
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('brand_id')
                                    <p class="mt-2 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                    </div>

                </div>



                {{-- ====================================================== --}}
                {{-- RIGHT SIDE --}}
                {{-- ====================================================== --}}
                <div class="space-y-6">


                    {{-- Update Product --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <h2 class="text-lg font-semibold text-white">
                            Update Product
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-400">
                            Make sure all product information is correct before saving your changes.
                        </p>

                        <button
                            type="submit"
                            class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-500"
                        >
                            <i class="fa-solid fa-floppy-disk"></i>
                            Update Product
                        </button>

                        <a
                            href="{{ route('admin.products') }}"
                            class="mt-3 flex w-full items-center justify-center gap-2 rounded-xl border border-white/10 bg-[#020617] px-5 py-3 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white"
                        >
                            Cancel
                        </a>

                    </div>



                    {{-- Main Image --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-5">
                            <h2 class="text-lg font-semibold text-white">
                                Main Image
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Update the main product image.
                            </p>
                        </div>


                        <label
                            for="image"
                            class="flex cursor-pointer flex-col items-center justify-center rounded-xl border border-dashed border-white/10 bg-[#020617] px-6 py-8 text-center transition hover:border-blue-600"
                        >

                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600/10">
                                <i class="fa-solid fa-cloud-arrow-up text-xl text-blue-500"></i>
                            </div>

                            <p class="text-sm font-medium text-white">
                                Choose a new image
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                JPG, JPEG, PNG or WEBP
                            </p>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="hidden"
                            >
                        </label>


                        @error('image')
                            <p class="mt-2 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror


                        {{-- Current / New Image Preview --}}
                        <div
                            id="image-preview-container"
                            class="relative mt-4 overflow-hidden rounded-xl border border-white/10 bg-[#020617]"
                        >

                            <img
                                id="image-preview"
                                src="{{ $product->image ? asset('storage/' . $product->image) : '' }}"
                                alt="{{ $product->name }}"
                                class="h-56 w-full object-contain"
                            >

                            <button
                                type="button"
                                id="remove-image"
                                class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-lg bg-black/60 text-white backdrop-blur transition hover:bg-red-600"
                            >
                                <i class="fa-solid fa-xmark"></i>
                            </button>

                        </div>

                    </div>



                    {{-- Gallery --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-5">
                            <h2 class="text-lg font-semibold text-white">
                                Product Gallery
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Upload gallery images for this product.
                            </p>
                        </div>


                        <label
                            for="images"
                            class="flex cursor-pointer flex-col items-center justify-center rounded-xl border border-dashed border-white/10 bg-[#020617] px-6 py-8 text-center transition hover:border-blue-600"
                        >

                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600/10">
                                <i class="fa-solid fa-images text-xl text-blue-500"></i>
                            </div>

                            <p class="text-sm font-medium text-white">
                                Choose gallery images
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                You can select multiple images
                            </p>

                            <input
                                type="file"
                                id="images"
                                name="images[]"
                                accept=".jpg,.jpeg,.png,.webp"
                                multiple
                                class="hidden"
                            >

                        </label>


                        @error('images')
                            <p class="mt-2 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                        @error('images.*')
                            <p class="mt-2 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror


                        {{-- Existing Gallery --}}
                        @php
                            $existingImages = $product->images
                                ? array_filter(explode(',', $product->images))
                                : [];
                        @endphp


                        @if (count($existingImages))
                            <div class="mt-5">

                                <p class="mb-3 text-xs font-medium uppercase tracking-wide text-slate-500">
                                    Current Images
                                </p>

                                <div
                                    id="existing-gallery"
                                    class="grid grid-cols-2 gap-3"
                                >

                                    @foreach ($existingImages as $image)
                                        <div class="group relative overflow-hidden rounded-xl border border-white/10 bg-[#020617]">

                                            <img
                                                src="{{ asset('storage/' . $image) }}"
                                                alt="{{ $product->name }}"
                                                class="h-28 w-full object-cover"
                                            >

                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        @endif


                        {{-- New Gallery Preview --}}
                        <div
                            id="gallery-preview"
                            class="mt-5 grid grid-cols-2 gap-3"
                        ></div>

                    </div>

                </div>

            </div>

        </form>

    </div>



    {{-- ================================================================ --}}
    {{-- JAVASCRIPT --}}
    {{-- ================================================================ --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | Main Image Preview
            |--------------------------------------------------------------------------
            */

            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');
            const imagePreviewContainer = document.getElementById('image-preview-container');
            const removeImageButton = document.getElementById('remove-image');

            let originalImage = imagePreview ? imagePreview.src : '';

            if (imageInput) {

                imageInput.addEventListener('change', function (event) {

                    const file = event.target.files[0];

                    if (!file) {
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function (e) {

                        imagePreview.src = e.target.result;

                        imagePreviewContainer.classList.remove('hidden');

                    };

                    reader.readAsDataURL(file);

                });

            }


            if (removeImageButton) {

                removeImageButton.addEventListener('click', function () {

                    imageInput.value = '';

                    /*
                     * Restore the original image instead of permanently
                     * removing it from the database.
                     */
                    imagePreview.src = originalImage;

                });

            }



            /*
            |--------------------------------------------------------------------------
            | Gallery Preview
            |--------------------------------------------------------------------------
            */

            const galleryInput = document.getElementById('images');
            const galleryPreview = document.getElementById('gallery-preview');

            if (galleryInput) {

                galleryInput.addEventListener('change', function (event) {

                    galleryPreview.innerHTML = '';

                    const files = Array.from(event.target.files);

                    files.forEach(function (file) {

                        const reader = new FileReader();

                        reader.onload = function (e) {

                            const wrapper = document.createElement('div');

                            wrapper.className =
                                'relative overflow-hidden rounded-xl border border-white/10 bg-[#020617]';

                            wrapper.innerHTML = `
                                <img
                                    src="${e.target.result}"
                                    class="h-28 w-full object-cover"
                                    alt="Gallery preview"
                                >
                            `;

                            galleryPreview.appendChild(wrapper);

                        };

                        reader.readAsDataURL(file);

                    });

                });

            }

        });

    </script>

</x-admin-layout>