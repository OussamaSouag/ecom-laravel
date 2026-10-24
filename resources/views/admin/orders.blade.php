<x-admin-layout>
    <div class="min-h-screen bg-[#020617] p-4 text-white sm:p-6 lg:p-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">
                    Orders Management
                </h1>
                <p class="mt-2 text-sm text-slate-400">
                    Manage customer orders and update their status.
                </p>
            </div>

            <div class="rounded-xl border border-white/10 bg-[#0f172a] px-5 py-3">
                <p class="text-xs text-slate-400">Total orders on this page</p>
                <p class="mt-1 text-2xl font-bold">{{ $orders->total() }}</p>
            </div>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm text-green-400">
                <i class="fa-solid fa-circle-check mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-400">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Filters --}}
        <div class="mb-6 rounded-2xl border border-white/10 bg-[#0f172a] p-4 sm:p-5">
            <form action="{{ route('admin.orders') }}" method="GET"
                  class="flex flex-col gap-3 md:flex-row">

                <div class="relative flex-1">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by order ID, customer, or phone..."
                        class="w-full rounded-xl border border-white/10 bg-[#020617] py-3 pl-11 pr-4 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:ring-blue-500"
                    >
                </div>

                <select
                    name="status"
                    class="rounded-xl border border-white/10 bg-[#020617] px-4 py-3 text-sm text-white focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="">All statuses</option>
                    @foreach (['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold transition hover:bg-blue-500">
                    Filter
                </button>

                @if (request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.orders') }}"
                       class="rounded-xl border border-white/10 px-5 py-3 text-center text-sm font-semibold text-slate-300 transition hover:bg-white/5">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Orders Table --}}
        <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#0f172a]">

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] text-left text-sm">
                    <thead class="border-b border-white/10 bg-white/[0.02] text-xs uppercase tracking-wider text-slate-400">
                        <tr>
                            <th class="px-6 py-4">Order</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Products</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Update status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/5">
                        @forelse ($orders as $order)
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                    'confirmed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'processing' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
                                    'shipped' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/20',
                                    'delivered' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    'cancelled' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                ];

                                $statusColor = $statusColors[$order->status] ?? 'bg-slate-500/10 text-slate-400 border-slate-500/20';
                            @endphp

                            <tr class="transition hover:bg-white/[0.02]">
                                {{-- Order ID --}}
                                <td class="px-6 py-5">
                                    <span class="font-semibold text-white">
                                        #{{ $order->id }}
                                    </span>
                                </td>

                                {{-- Customer --}}
                                <td class="px-6 py-5">
                                    <p class="font-medium text-white">{{ $order->name }}</p>
                                    <a href="tel:{{ $order->number }}"
                                       class="mt-1 inline-block text-xs text-slate-400 transition hover:text-blue-400">
                                        <i class="fa-solid fa-phone mr-1"></i>
                                        {{ $order->number }}
                                    </a>
                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $order->commune }}, {{ $order->wilaya }}
                                    </p>
                                </td>

                                {{-- Products --}}
                                <td class="px-6 py-5">
                                    <p class="font-medium text-white">
                                        {{ $order->items->sum('quantity') }}
                                        {{ \Illuminate\Support\Str::plural('item', $order->items->sum('quantity')) }}
                                    </p>

                                    <div class="mt-1 max-w-[220px] space-y-1">
                                        @foreach ($order->items->take(2) as $item)
                                            <p class="truncate text-xs text-slate-400">
                                                {{ $item->product_name }} × {{ $item->quantity }}
                                            </p>
                                        @endforeach

                                        @if ($order->items->count() > 2)
                                            <p class="text-xs text-blue-400">
                                                +{{ $order->items->count() - 2 }} more
                                            </p>
                                        @endif
                                    </div>
                                </td>

                                {{-- Total --}}
                                <td class="px-6 py-5">
                                    <p class="font-semibold text-white">
                                        {{ number_format((float) $order->total, 2) }}
                                    </p>
                                    @if ((float) $order->discount > 0)
                                        <p class="mt-1 text-xs text-green-400">
                                            Discount: {{ number_format((float) $order->discount, 2) }}
                                        </p>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-5">
                                    <span class="inline-flex rounded-full border px-3 py-1 text-xs font-semibold {{ $statusColor }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-5 whitespace-nowrap text-slate-400">
                                    {{ $order->created_at->format('d M Y') }}
                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $order->created_at->format('H:i') }}
                                    </p>
                                </td>

                                {{-- Update Status --}}
                                <td class="px-6 py-5">
                                    <form action="{{ route('admin.order.status', $order->id) }}"
                                          method="POST"
                                          class="flex min-w-[210px] flex-col gap-2">
                                        @csrf
                                        @method('PUT')

                                        <select
                                            name="status"
                                            class="w-full rounded-lg border border-white/10 bg-[#020617] px-3 py-2 text-xs text-white focus:border-blue-500 focus:ring-blue-500"
                                        >
                                            @foreach (['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                                <option value="{{ $status }}" @selected($order->status === $status)>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button type="submit"
                                                class="rounded-lg bg-blue-600 px-3 py-2 text-xs font-semibold transition hover:bg-blue-500">
                                            <i class="fa-solid fa-floppy-disk mr-1"></i>
                                            Save status
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Order Details --}}
                            <tr class="bg-[#020617]/40">
                                <td colspan="7" class="px-6 py-4">
                                    <details class="group">
                                        <summary class="flex cursor-pointer list-none items-center gap-2 text-xs font-semibold text-blue-400 hover:text-blue-300">
                                            <i class="fa-solid fa-chevron-right transition group-open:rotate-90"></i>
                                            View full order details
                                        </summary>

                                        <div class="mt-4 grid gap-5 lg:grid-cols-2">
                                            {{-- Address --}}
                                            <div class="rounded-xl border border-white/10 bg-[#0f172a] p-4">
                                                <h3 class="mb-3 text-sm font-semibold text-white">
                                                    <i class="fa-solid fa-location-dot mr-2 text-blue-400"></i>
                                                    Delivery information
                                                </h3>

                                                <p class="text-sm text-slate-300">{{ $order->name }}</p>
                                                <p class="mt-1 text-sm text-slate-400">{{ $order->number }}</p>
                                                <p class="mt-1 text-sm text-slate-400">
                                                    {{ $order->address }}
                                                </p>
                                                <p class="mt-1 text-sm text-slate-400">
                                                    {{ $order->commune }}, {{ $order->wilaya }}
                                                </p>
                                            </div>

                                            {{-- Items --}}
                                            <div class="rounded-xl border border-white/10 bg-[#0f172a] p-4">
                                                <h3 class="mb-3 text-sm font-semibold text-white">
                                                    <i class="fa-solid fa-box mr-2 text-blue-400"></i>
                                                    Order items
                                                </h3>

                                                <div class="space-y-3">
                                                    @forelse ($order->items as $item)
                                                        <div class="flex items-center justify-between gap-4 border-b border-white/5 pb-3 last:border-0 last:pb-0">
                                                            <div class="flex min-w-0 items-center gap-3">
                                                                @if ($item->product_image)
                                                                    <img
                                                                        src="{{ asset('storage/' . $item->product_image) }}"
                                                                        alt="{{ $item->product_name }}"
                                                                        class="h-12 w-12 rounded-lg border border-white/10 object-cover"
                                                                    >
                                                                @else
                                                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-white/5 text-slate-500">
                                                                        <i class="fa-solid fa-image"></i>
                                                                    </div>
                                                                @endif

                                                                <div class="min-w-0">
                                                                    <p class="truncate text-sm font-medium text-white">
                                                                        {{ $item->product_name }}
                                                                    </p>
                                                                    <p class="mt-1 text-xs text-slate-400">
                                                                        {{ number_format((float) $item->price, 2) }}
                                                                        × {{ $item->quantity }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <p class="shrink-0 text-sm font-semibold text-white">
                                                                {{ number_format((float) $item->subtotal, 2) }}
                                                            </p>
                                                        </div>
                                                    @empty
                                                        <p class="text-sm text-slate-500">
                                                            No items found for this order.
                                                        </p>
                                                    @endforelse
                                                </div>

                                                <div class="mt-4 space-y-2 border-t border-white/10 pt-3 text-sm">
                                                    <div class="flex justify-between text-slate-400">
                                                        <span>Subtotal</span>
                                                        <span>{{ number_format((float) $order->subtotal, 2) }}</span>
                                                    </div>

                                                    <div class="flex justify-between text-slate-400">
                                                        <span>Discount</span>
                                                        <span>-{{ number_format((float) $order->discount, 2) }}</span>
                                                    </div>

                                                    <div class="flex justify-between border-t border-white/10 pt-3 font-bold text-white">
                                                        <span>Total</span>
                                                        <span>{{ number_format((float) $order->total, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </details>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/5 text-slate-500">
                                        <i class="fa-solid fa-box-open text-xl"></i>
                                    </div>

                                    <h3 class="mt-4 font-semibold text-white">No orders found</h3>
                                    <p class="mt-2 text-sm text-slate-400">
                                        Orders will appear here when customers place them.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($orders->hasPages())
                <div class="border-t border-white/10 px-6 py-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>

