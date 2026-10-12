<x-admin-layout>

    {{-- <main class="flex-1 overflow-y-auto bg-[#020617] p-6 lg:p-8">

        {{-- Page Header --}}
    <div class="mb-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">
                Categories
            </h1>

            <p class="mt-1 text-sm text-slate-400">
                Manage product categories
            </p>
        </div>

        <a href="{{ route('admin.category.add') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5
                       text-sm font-semibold text-white shadow-lg shadow-blue-600/20
                       transition hover:bg-blue-500">
            <i class="fa-solid fa-plus text-xs"></i>
            Add New Category
        </a>
    </div>


    {{-- Filters --}}
    <div class="mb-6 rounded-2xl border border-white/10 bg-[#0f172a] p-4">

        <div class="flex flex-col justify-between gap-4 md:flex-row">

            <div class="flex w-full flex-col gap-4 md:w-auto md:flex-row">

                {{-- Search --}}
                <div class="relative w-full md:w-64">
                    <form method="GET" action="{{ route('admin.categories') }}">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <button type="submit"> <i class="fa-solid fa-magnifying-glass text-sm text-slate-500"></i>
                            </button>
                        </span>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search category..."
                            class="w-full rounded-xl border border-white/10
                                   bg-[#020617] py-2.5 pl-10 pr-4
                                   text-sm text-white
                                   placeholder:text-slate-600
                                   outline-none transition
                                   focus:border-blue-500/50
                                   focus:ring-2 focus:ring-blue-500/10">

                </div>
                </form>


                {{-- Parent Category --}}
                <select
                    class="w-full rounded-xl border border-white/10
                               bg-[#020617] px-3 py-2.5
                               text-sm text-slate-300
                               outline-none transition
                               focus:border-blue-500/50
                               focus:ring-2 focus:ring-blue-500/10
                               md:w-48">


                    @foreach ($categories as $category)
                        <option value="" class="bg-[#0f172a]">
                            {{ $category->name }}
                        </option>
                    @endforeach


                </select>

            </div>

        </div>

    </div>


    {{-- Categories Table --}}
    <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#0f172a]">

        <div class="overflow-x-auto">

            <table class="w-full whitespace-nowrap text-left">

                {{-- Table Header --}}
                <thead class="bg-white/[0.02] text-xs font-semibold uppercase tracking-wide text-slate-500">

                    <tr>

                        <th class="px-6 py-4">
                            <input type="checkbox"
                                class="h-4 w-4 rounded border-white/20 bg-[#020617]
                                           text-blue-600 focus:ring-blue-500/30">
                        </th>

                        <th class="px-6 py-4">
                            ID
                        </th>

                        <th class="px-6 py-4">
                            Image/Icon
                        </th>

                        <th class="px-6 py-4">
                            Category Name
                        </th>

                        <th class="px-6 py-4">
                            Slug
                        </th>
                        <th class="px-6 py-4">
                            Parent Category
                        </th>

                        <th class="px-6 py-4">
                            Items
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right">
                            Action
                        </th>

                    </tr>

                </thead>


                {{-- Table Body --}}
                <tbody class="divide-y divide-white/5">

                    {{-- Example Category --}}
                    @forelse ($categories as $category)
                        <tr class="transition hover:bg-white/[0.02]">

                            <td class="px-6 py-4">

                                <input type="checkbox"
                                    class="h-4 w-4 rounded border-white/20 bg-[#020617]
                                           text-blue-600 focus:ring-blue-500/30">

                            </td>


                            <td class="px-6 py-4 text-sm text-slate-500">
                                #CAT-00{{ $category->id }}
                            </td>


                            {{-- Icon --}}
                            <td class="px-6 py-4">

                                <div
                                    class="flex h-10 w-10 items-center justify-center
                                           rounded-xl bg-white/5 text-slate-400">
                                    <img src="{{ asset('storage/' . $category->image) }}"
                                        class="max-h-8 max-w-8 object-contain" alt="{{ $category->name }}">
                                </div>

                            </td>


                            {{-- Name --}}
                            <td class="px-6 py-4">

                                <span class="font-semibold text-white">
                                    {{ $category->name }}
                                </span>

                            </td>


                            {{-- Slug --}}
                            <td class="px-6 py-4 text-sm text-slate-400">
                                {{ $category->slug }}

                            </td>

                            {{-- Parent Category --}}
                            <td class="px-6 py-4 text-sm text-slate-400">
                                {{ $category->parent ? $category->parent->name : 'N/A' }}
                            </td>

                            {{-- Items --}}
                            <td class="px-6 py-4">

                                <span
                                    class="rounded-lg bg-blue-500/10 px-2.5 py-1
                                           text-xs font-semibold text-blue-400">
                                    1,240
                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                <span
                                    class="rounded-full bg-emerald-500/10
                                           px-2.5 py-1
                                           text-xs font-semibold
                                           text-emerald-400">
                                    {{ $category->status }}
                                </span>

                            </td>



                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                        class="flex h-9 w-9 items-center justify-center
                                               rounded-lg text-slate-400
                                               transition
                                               hover:bg-blue-500/10
                                               hover:text-blue-400"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>


                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('admin.category.delete', $category->id) }}">
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex h-9 w-9 items-center justify-center
                                               rounded-lg text-slate-400
                                               transition
                                               hover:bg-red-500/10
                                               hover:text-red-400">

                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>
                        @empty


                            {{-- Empty State --}}
                            <tr>

                                <td colspan="8" class="px-6 py-16 text-center">

                                    <div class="flex flex-col items-center justify-center">

                                        <div
                                            class="mb-4 flex h-14 w-14 items-center justify-center
                                               rounded-2xl bg-white/5">
                                            <i class="fa-solid fa-boxes-stacked text-2xl text-slate-500"></i>
                                        </div>

                                        <h3 class="text-lg font-semibold text-white">
                                            Categories not available
                                        </h3>

                                        <p class="mt-1 max-w-sm text-sm text-slate-500">
                                            You haven't added any categories to your store yet.
                                        </p>

                                        <a href=" # "
                                            class="mt-5 inline-flex items-center gap-2
                                               rounded-xl bg-blue-600 px-4 py-2.5
                                               text-sm font-semibold text-white
                                               shadow-lg shadow-blue-600/20
                                               transition hover:bg-blue-500">
                                            <i class="fa-solid fa-plus text-xs"></i>
                                            Add your first category
                                        </a>

                                    </div>

                                </td>
                        @endforelse
                       

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            <div class="flex flex-col items-center justify-between gap-4
                       px-6 py-4 sm:flex-row">

                <span class="text-sm text-slate-500">

                    Showing
                    <span class="font-semibold text-slate-300">
                        1-4
                    </span>

                    of

                    <span class="font-semibold text-slate-300">
                        18
                    </span>

                    categories

                </span>


                <div class="flex gap-2">

                    <button
                        class="rounded-lg border border-white/10
                               bg-white/[0.02]
                               px-3 py-1.5
                               text-sm text-slate-500
                               opacity-50"
                        disabled>
                        Previous
                    </button>


                    <button
                        class="rounded-lg bg-blue-600
                               px-3 py-1.5
                               text-sm font-medium text-white">
                        1
                    </button>


                    <button
                        class="rounded-lg border border-white/10
                               bg-white/[0.02]
                               px-3 py-1.5
                               text-sm text-slate-400
                               transition hover:bg-white/5 hover:text-white">
                        2
                    </button>


                    <button
                        class="rounded-lg border border-white/10
                               bg-white/[0.02]
                               px-3 py-1.5
                               text-sm text-slate-400
                               transition hover:bg-white/5 hover:text-white">
                        Next
                    </button>

                </div>

            </div>

        </div>

        </main>

    </x-admin-layout>
