<x-admin-layout>

    <main class="flex-1 overflow-y-auto bg-[#020617] p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="mb-7 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">

            <div>
                <h1 class="text-2xl font-bold tracking-tight text-white">
                    Add New Category
                </h1>

                <p class="mt-1 text-sm text-slate-400">
                    Add a new Category to your store
                </p>
            </div>

            <a href="{{route('admin.categories')}}"
                class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-[#0f172a] px-5 py-2.5 text-sm font-semibold text-slate-300 transition hover:bg-white/5 hover:text-white">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to Categories
            </a>

        </div>


        {{-- Form --}}
        <div class="mx-auto max-w-3xl">

            <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data"
                class="space-y-6 rounded-2xl border border-white/10 bg-[#0f172a] p-6 shadow-2xl shadow-black/10 sm:p-8">

                @csrf


                {{-- Category Information --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Category Name --}}
                    <div>

                        <label for="name" class="mb-2 block text-sm font-medium text-slate-200">
                            Category Name <span class="text-blue-400">*</span>
                        </label>

                        <input type="text" id="name" name="name" placeholder="e.g. Phone"
                            class="h-11 w-full rounded-xl border border-white/10 bg-[#020617] px-4 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10">

                    </div>


                    {{-- Slug --}}
                    <div>

                        <label for="slug" class="mb-2 block text-sm font-medium text-slate-200">
                            Category Slug
                        </label>

                        <input type="text" id="slug" name="slug" placeholder="phone"
                            class="h-11 w-full rounded-xl border border-white/10 bg-[#020617] px-4 text-sm text-white placeholder:text-slate-600 outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10">

                        <p class="mt-2 text-xs text-slate-500">
                            Used in the Category URL.
                        </p>

                    </div>

                </div>
                 <div>
                            <label class="block text-sm font-medium text-slate-200 mb-1">Parent Category</label>
                            <select  id="parent_id" name="parent_id" class="w-full border  bg-[#020617] px-4 py-2 rounded-lg outline-none">
                                <option bg-[#020617] value="">select Parent Category</option>
                                @foreach($parentCategories as $parentCategory)
                                    <option bg-[#020617]   value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>


                {{-- Category Logo --}}
                <div>

                    <label for="Category-image" class="mb-2 block text-sm font-medium text-slate-200">
                        Category Logo <span class="text-blue-400">*</span>
                    </label>


                    <div class="relative flex h-44 w-full items-center justify-center">

                        <label for="Category-image"
                            class="relative flex h-full w-full cursor-pointer flex-col items-center justify-center overflow-hidden rounded-xl border border-dashed border-white/10 bg-[#020617] transition hover:border-blue-500/40 hover:bg-white/[0.02]">

                            {{-- Upload Content --}}
                            <div id="upload-content" class="z-10 flex flex-col items-center justify-center">

                                <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-white/5">
                                    <i class="fa-solid fa-image text-xl text-slate-500"></i>
                                </div>

                                <p class="text-sm font-medium text-slate-300">
                                    Upload Category logo
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    PNG, JPG or WEBP
                                </p>

                            </div>


                            {{-- Image Preview --}}
                            <img id="image-preview"
                                class="absolute inset-0 z-20 hidden h-full w-full bg-[#020617] object-contain p-4"
                                src="" alt="Logo Preview">


                            <input id="Category-image" name="image" type="file" class="hidden"
                                accept="image/png, image/jpeg, image/jpg, image/webp" />

                        </label>


                        {{-- Remove Image --}}
                        <button type="button" id="remove-logo-btn"
                            class="absolute right-3 top-3 z-30 hidden flex h-8 w-8 items-center justify-center rounded-lg border border-white/10 bg-[#0f172a] text-slate-400 shadow-lg transition hover:bg-red-500/10 hover:text-red-400 focus:outline-none"
                            title="Remove image">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>

                    </div>

                    <p class="mt-2 text-xs text-slate-500">
                        Recommended: square logo with a transparent background.
                    </p>

                </div>


                {{-- Status --}}
                <div>

                    <label class="flex cursor-pointer items-center gap-3">

                        <input type="checkbox" id="status" name="status" value="1"
                            class="h-4 w-4 rounded border-white/20 bg-[#020617] text-blue-600 focus:ring-2 focus:ring-blue-500/20">

                        <span class="text-sm text-slate-300">
                            Set as Active Category
                        </span>

                    </label>

                </div>


                {{-- Actions --}}
                <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-6 sm:flex-row sm:justify-end">

                    <a href="{{ route('admin.categories') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-6 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white">
                        Cancel
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                        <i class="fa-solid fa-check text-xs"></i>
                        Save Category
                    </button>

                </div>

            </form>

        </div>

    </main>

</x-admin-layout>
