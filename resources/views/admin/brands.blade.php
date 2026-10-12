<x-admin-layout>

    <main class="flex-1 overflow-y-auto bg-[#020617] p-6 lg:p-8">

        {{-- Page Header --}}
        <div class="mb-7 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">

            <div>
                <h1 class="text-2xl font-bold tracking-tight text-white">
                    Brands
                </h1>

                <p class="mt-1 text-sm text-slate-400">
                    Manage product brands and partners
                </p>
            </div>

            <a href="{{ route('admin.brand.add') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500">
                <i class="fa-solid fa-plus"></i>
                Add New Brand
            </a>

        </div>


        {{-- Filters --}}
        <div class="mb-6 rounded-2xl border border-white/10 bg-[#0f172a] p-4">

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div class="flex w-full flex-col gap-3 sm:flex-row md:w-auto">

                    {{-- Search --}}
                    <div class="relative w-full sm:w-72">
                        <form action="{{route('admin.brands')  }}" method="GET">

                            <i
                                class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-500"></i>

                            <input type="text" placeholder="Search brand..." name="search" value="{{ request('search') }}"
                                class="h-11 w-full rounded-xl border border-white/10 bg-[#020617] pl-11 pr-4 text-sm text-white placeholder:text-slate-500 outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10">
                        </form>
                    </div>


                    {{-- Status --}}
                    <select
                        class="h-11 w-full rounded-xl border border-white/10 bg-[#020617] px-4 text-sm text-slate-300 outline-none transition focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10 sm:w-40">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>

                </div>

            </div>

        </div>


        {{-- Brands Table --}}
        <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#0f172a]">

            <div class="overflow-x-auto">

                <table class="w-full text-left whitespace-nowrap">

                    {{-- Table Header --}}
                    <thead class="border-b border-white/10 bg-white/[0.02]">

                        <tr class="text-xs font-semibold uppercase tracking-wider text-slate-500">

                            <th class="px-6 py-4">
                                ID
                            </th>

                            <th class="px-6 py-4">
                                Logo
                            </th>

                            <th class="px-6 py-4">
                                Brand Name
                            </th>

                            <th class="px-6 py-4">
                                Slug
                            </th>

                            <th class="px-6 py-4">
                                Products
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
                        @forelse ($brands as $brand)
                            {{-- Samsung --}}
                            <tr class="transition hover:bg-white/[0.02]">

                                {{-- ID --}}
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $brand->id }}
                                </td>


                                {{-- Logo --}}
                                <td class="px-6 py-4">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-[#020617]">

                                        <img src="{{ asset('storage/' . $brand->image) }}"
                                            class="max-h-8 max-w-8 object-contain" alt="{{ $brand->name }}">

                                    </div>

                                </td>


                                {{-- Name --}}
                                <td class="px-6 py-4">

                                    <span class="font-semibold text-white">
                                        {{ $brand->name }}
                                    </span>

                                </td>


                                {{-- Slug --}}
                                <td class="px-6 py-4 text-sm text-slate-400">
                                    {{ $brand->slug }}
                                </td>


                                {{-- Products --}}
                                <td class="px-6 py-4">

                                    <span
                                        class="inline-flex rounded-lg bg-blue-500/10 px-2.5 py-1 text-xs font-semibold text-blue-400">
                                        0
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-500/10 px-2.5 py-1 text-xs font-semibold text-emerald-400">

                                        @if ($brand->status)
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                                            Active

                                    </span>
                                @else
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-700"></span>

                                    Inactive

                                    </span>
                        @endif
                        </td>


                        {{-- Actions --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-end gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('admin.brand.edit', $brand->id) }}"
                                    class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-blue-500/10 hover:text-blue-400"
                                    title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </a>


                                {{-- Delete --}}
                                <form method='POST' action="{{ route('admin.brand.destroy', $brand->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-500/10 hover:text-red-400"
                                        title="Delete">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </button>
                                </form>

                            </div>

                        </td>

                        </tr>

                    @empty
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">

                                {{-- Icon --}}
                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/5">
                                    <i class="fa-solid fa-boxes-stacked text-2xl text-slate-500"></i>
                                </div>

                                {{-- Title --}}
                                <h3 class="text-lg font-semibold text-white">
                                    Brands not available
                                </h3>

                                {{-- Description --}}
                                <p class="mt-1 max-w-sm text-sm text-slate-500">
                                    You haven't added any brands to your store yet.
                                </p>

                                {{-- Action --}}
                                <a href="{{ route('admin.brand.add') }}"
                                    class="mt-5 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                    Add your first brand
                                </a>

                            </div>
                        </td>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            <div
                class="flex flex-col items-center justify-between gap-4 border-t border-white/10 px-6 py-4 sm:flex-row">

                <p class="text-sm text-slate-500">

                    Showing
                    <span class="font-semibold text-slate-300">1-2</span>
                    of
                    <span class="font-semibold text-slate-300">24</span>
                    brands

                </p>


                <div class="flex items-center gap-1.5">

                    {{ $brands->links() }}

                </div>

            </div>

        </div>

    </main>

</x-admin-layout>
