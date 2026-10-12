<x-admin-layout>

    <main class="flex-1 overflow-y-auto bg-[#020617] p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold text-white">
                    Add New Product
                </h1>

                <p class="mt-1 text-sm text-slate-400">
                    Create a new product for your store.
                </p>
            </div>

            <a href="{{ route('admin.products') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-[#0f172a] px-5 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">

                <i class="fa-solid fa-arrow-left"></i>

                Back to Products
            </a>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="mb-6 rounded-2xl border border-red-500/20 bg-red-500/10 p-4">

                <div class="flex items-start gap-3">

                    <i class="fa-solid fa-circle-exclamation mt-0.5 text-red-400"></i>

                    <div>

                        <h3 class="font-semibold text-red-400">
                            Please fix the following errors:
                        </h3>

                        <ul class="mt-2 space-y-1 text-sm text-red-300">

                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- Form --}}
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


                {{-- LEFT SIDE --}}
                <div class="space-y-6 xl:col-span-2">


                    {{-- Basic Information --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-6">

                            <h2 class="text-lg font-semibold text-white">
                                Basic Information
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Enter the main information about your product.
                            </p>

                        </div>


                        <div class="space-y-5">


                            {{-- Name --}}
                            <div>

                                <label for="name" class="mb-2 block text-sm font-medium text-slate-300">

                                    Product Name

                                    <span class="text-blue-500">*</span>

                                </label>

                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    placeholder="e.g. Samsung Galaxy S25"
                                    class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                                @error('name')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Description --}}
                            <div>

                                <label for="description" class="mb-2 block text-sm font-medium text-slate-300">

                                    Description

                                    <span class="text-blue-500">*</span>

                                </label>

                                <textarea id="description" name="description" rows="7" placeholder="Describe your product..."
                                    class="w-full resize-none rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">{{ old('description') }}</textarea>

                                @error('description')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Short Description --}}
                            <div>

                                <label for="short_description" class="mb-2 block text-sm font-medium text-slate-300">

                                    Short Description

                                </label>

                                <textarea id="short_description" name="short_description" rows="3" placeholder="Brief summary of the product..."
                                    class="w-full resize-none rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">{{ old('short_description') }}</textarea>

                                @error('short_description')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Slug --}}
                            <div>

                                <label for="slug" class="mb-2 block text-sm font-medium text-slate-300">

                                    Slug

                                </label>

                                <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                    placeholder="e.g. samsung-galaxy-s25"
                                    class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                                @error('slug')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- SKU --}}
                            <div>

                                <label for="SKU" class="mb-2 block text-sm font-medium text-slate-300">

                                    SKU

                                </label>

                                <input type="text" id="SKU" name="SKU" value="{{ old('SKU') }}"
                                    placeholder="Product SKU"
                                    class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                                @error('SKU')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>



                    {{-- Pricing & Inventory --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-6">

                            <h2 class="text-lg font-semibold text-white">
                                Pricing & Inventory
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Set the price and available stock.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                            {{-- Price --}}
                            <div>

                                <label for="price" class="mb-2 block text-sm font-medium text-slate-300">

                                    Price

                                    <span class="text-blue-500">*</span>

                                </label>

                                <div class="relative">

                                    <input type="number" step="0.01" min="0" id="price" name="price"
                                        value="{{ old('price') }}" placeholder="0.00"
                                        class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 pr-14 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm text-slate-500">
                                        DA
                                    </span>

                                </div>

                                @error('price')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Sale Price --}}
                            <div>

                                <label for="sale_price" class="mb-2 block text-sm font-medium text-slate-300">

                                    Sale Price

                                </label>

                                <div class="relative">

                                    <input type="number" step="0.01" min="0" id="sale_price" name="sale_price"
                                        value="{{ old('sale_price') }}" placeholder="Optional"
                                        class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 pr-14 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm text-slate-500">
                                        DA
                                    </span>

                                </div>

                                <p class="mt-1.5 text-xs text-slate-500">
                                    Leave empty if there is no discount.
                                </p>

                                @error('saleprice')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Stock --}}
                            <div>

                                <label for="stock" class="mb-2 block text-sm font-medium text-slate-300">

                                    Stock

                                    <span class="text-blue-500">*</span>

                                </label>

                                <input type="number" min="0" id="stock" name="stock"
                                    value="{{ old('stock', 0) }}" placeholder="0"
                                    class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                                @error('stock')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>



                {{-- RIGHT SIDE --}}
                <div class="space-y-6">


                    {{-- Publish --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <h2 class="mb-5 text-lg font-semibold text-white">
                            Publish
                        </h2>


                        <div class="rounded-xl border border-white/10 bg-[#020617] p-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600/10">

                                    <i class="fa-solid fa-box text-blue-500"></i>

                                </div>

                                <div>

                                    <p class="text-sm font-medium text-white">
                                        Product Ready
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        Add the required information below.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Status --}}
                        {{-- <div class="mt-5">

                            <label for="status" class="mb-2 block text-sm font-medium text-slate-300">

                                Status

                                <span class="text-blue-500">*</span>

                            </label>

                            <select id="status" name="status"
                                class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                                <option value="">
                                    Select status
                                </option>

                                <option value="Draft" @selected(old('status') === 'Draft')>
                                    Draft
                                </option>

                                <option value="Published" @selected(old('status') === 'Published')>
                                    Published
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-1.5 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div> --}}


                       


                        {{-- Submit --}}
                        <button type="submit"
                            class="mt-5 w-full rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50">

                            <i class="fa-solid fa-plus mr-2"></i>

                            Create Product

                        </button>

                    </div>



                    {{-- Organization --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-5">

                            <h2 class="text-lg font-semibold text-white">
                                Organization
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Assign this product to a category and brand.
                            </p>

                        </div>


                        <div class="space-y-5">


                            {{-- Category --}}
                            <div>

                                <label for="category_id" class="mb-2 block text-sm font-medium text-slate-300">

                                    Category

                                    <span class="text-blue-500">*</span>

                                </label>

                                <select id="category_id" name="category_id"
                                    class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                                    <option value="">
                                        Select Category
                                    </option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('category_id')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Brand --}}
                            <div>

                                <label for="brand_id" class="mb-2 block text-sm font-medium text-slate-300">

                                    Brand

                                    <span class="text-blue-500">*</span>

                                </label>

                                <select id="brand_id" name="brand_id"
                                    class="w-full rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white outline-none transition focus:border-blue-600 focus:ring-1 focus:ring-blue-600">

                                    <option value="">
                                        Select Brand
                                    </option>

                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('brand_id')
                                    <p class="mt-1.5 text-sm text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>



                    {{-- Product Image --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-5">

                            <h2 class="text-lg font-semibold text-white">
                                Product Image
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Upload the main product image.
                            </p>

                        </div>


                        <label for="product-image"
                            class="block cursor-pointer rounded-xl border-2 border-dashed border-white/10 bg-[#020617] p-6 text-center transition hover:border-blue-600/50 hover:bg-white/[0.02]">

                            <div class="flex flex-col items-center">

                                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600/10">

                                    <i class="fa-solid fa-cloud-arrow-up text-xl text-blue-500"></i>

                                </div>

                                <p class="text-sm font-medium text-white">
                                    Click to upload
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    PNG, JPG, JPEG or WEBP
                                </p>

                            </div>

                            <input type="file" id="product-image" name="image" class="hidden"
                                accept="image/png,image/jpeg,image/jpg,image/webp">

                        </label>


                        @error('image')
                            <p class="mt-1.5 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror


                        {{-- Preview --}}
                        <div id="image-preview-container"
                            class="relative mt-4 hidden overflow-hidden rounded-xl border border-white/10 bg-[#020617]">

                            <img id="image-preview" src="" alt="Preview"
                                class="h-48 w-full object-contain">

                            <button type="button" id="remove-image"
                                class="absolute right-2 top-2 flex h-8 w-8 items-center justify-center rounded-lg bg-red-500 text-white transition hover:bg-red-600">

                                <i class="fa-solid fa-xmark"></i>

                            </button>

                        </div>

                    </div>



                    {{-- Product Gallery --}}
                    <div class="rounded-2xl border border-white/10 bg-[#0f172a] p-6">

                        <div class="mb-5">

                            <h2 class="text-lg font-semibold text-white">
                                Product Gallery
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                Upload additional images for this product.
                            </p>

                        </div>


                        <label for="product-images"
                            class="block cursor-pointer rounded-xl border-2 border-dashed border-white/10 bg-[#020617] p-6 text-center transition hover:border-blue-600/50 hover:bg-white/[0.02]">

                            <div class="flex flex-col items-center">

                                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600/10">

                                    <i class="fa-solid fa-images text-xl text-blue-500"></i>

                                </div>

                                <p class="text-sm font-medium text-white">
                                    Click to upload gallery images
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    You can select multiple images
                                </p>

                            </div>

                            <input type="file" id="product-images" name="images[]" class="hidden" multiple
                                accept="image/png,image/jpeg,image/jpg,image/webp">

                        </label>


                        @error('images')
                            <p class="mt-1.5 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                        @error('images.*')
                            <p class="mt-1.5 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror


                        <div id="gallery-preview" class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3"></div>

                    </div>


                </div>

            </div>

        </form>

    </main>



    {{-- Image Preview --}}
    <script>
        // Main image preview
        const imageInput = document.getElementById('product-image');
        const imagePreviewContainer = document.getElementById('image-preview-container');
        const imagePreview = document.getElementById('image-preview');
        const removeImage = document.getElementById('remove-image');

        imageInput.addEventListener('change', function() {

            const file = this.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {

                imagePreview.src = e.target.result;

                imagePreviewContainer.classList.remove('hidden');

            };

            reader.readAsDataURL(file);

        });


        removeImage.addEventListener('click', function() {

            imageInput.value = '';

            imagePreview.src = '';

            imagePreviewContainer.classList.add('hidden');

        });



        // Gallery preview
        const galleryInput = document.getElementById('product-images');
        const galleryPreview = document.getElementById('gallery-preview');

        galleryInput.addEventListener('change', function() {

            galleryPreview.innerHTML = '';

            Array.from(this.files).forEach((file) => {

                const reader = new FileReader();

                reader.onload = function(e) {

                    const wrapper = document.createElement('div');

                    wrapper.className =
                        'relative h-32 overflow-hidden rounded-xl border border-white/10 bg-[#020617]';

                    wrapper.innerHTML = `
                        <img
                            src="${e.target.result}"
                            alt="Gallery preview"
                            class="h-full w-full object-cover"
                        >
                    `;

                    galleryPreview.appendChild(wrapper);

                };

                reader.readAsDataURL(file);

            });

        });
    </script>

</x-admin-layout>
