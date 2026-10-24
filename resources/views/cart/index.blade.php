
<x-app-layout>
    {{-- Page Banner --}}
    <div
        class="relative flex h-64 items-center justify-center bg-sky-700 bg-cover bg-center text-white"
        style="background-image: url('{{ asset('assets/images/page-banner.jpg') }}');"
    >
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 text-center">
            <h2 class="mb-2 text-4xl font-bold">Cart</h2>

            <ul class="flex justify-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('landing') }}" class="hover:text-primary">
                        Home
                    </a>
                </li>
                <li>/</li>
                <li class="text-primary">Cart</li>
            </ul>
        </div>
    </div>

    {{-- Cart Content --}}
    <section class="py-16">
        <div class="container mx-auto px-4">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $cartItems = Cart::instance('cart')->content();

                // Calculate subtotal from individual cart items.
                $cartSubtotal = (float) $cartItems->sum('subtotal');

                $coupon = session('coupon');
                $discountData = session('discount', []);
                $discountAmount = $coupon
                    ? (float) ($discountData['discount'] ?? 0)
                    : 0;

                $discountAmount = min(max(0, $discountAmount), $cartSubtotal);
                $finalTotal = max(0, $cartSubtotal - $discountAmount);
            @endphp

            @if ($cartItems->isEmpty())

                {{-- Empty Cart --}}
                <div id="empty-cart" class="py-10 text-center">
                    <h2 class="mb-4 text-2xl font-bold">
                        Your cart is empty
                    </h2>

                    <img
                        src="{{ asset('assets/images/cart.png') }}"
                        alt="Empty cart"
                        class="mx-auto mb-6 max-w-xs"
                    >

                    <p class="mb-6 text-gray-500">
                        No items found in your cart.
                    </p>

                    <a
                        href="{{ route('shop.index') }}"
                        class="inline-block rounded bg-primary px-6 py-2 text-white transition hover:bg-blue-600"
                    >
                        Continue Shopping
                    </a>
                </div>

            @else

                <div id="cart-content" class="cart-wrapper">

                    {{-- Products Table --}}
                    <div class="mb-8 overflow-x-auto">
                        <table class="w-full cart-table">
                            <thead class="border-b bg-gray-100">
                                <tr>
                                    <th class="px-4 py-4 text-left font-bold text-gray-700">
                                        Image
                                    </th>
                                    <th class="px-4 py-4 text-left font-bold text-gray-700">
                                        Product Information
                                    </th>
                                    <th class="px-4 py-4 text-left font-bold text-gray-700">
                                        Quantity
                                    </th>
                                    <th class="px-4 py-4 text-left font-bold text-gray-700">
                                        Total Price
                                    </th>
                                    <th class="px-4 py-4 text-left font-bold text-gray-700">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($cartItems as $item)
                                    @php
                                        $product = Cart::instance('cart')->model($item->rowId);
                                    @endphp

                                    <tr>
                                        {{-- Product Image --}}
                                        <td class="px-4 py-4">
                                            <a href="{{ route('shop.show', ['slug' => $product->slug]) }}">
                                                <img
                                                    src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/cart.png') }}"
                                                    alt="{{ $item->name }}"
                                                    class="h-20 w-20 rounded object-contain"
                                                >
                                            </a>
                                        </td>

                                        {{-- Product Information --}}
                                        <td class="px-4 py-4">
                                            <h6 class="font-bold text-gray-800">
                                                <a
                                                    href="{{ route('shop.show', ['slug' => $product->slug]) }}"
                                                    class="hover:text-primary"
                                                >
                                                    {{ $item->name }}
                                                </a>
                                            </h6>

                                            <div class="mt-1 text-sm">
                                                <span class="font-bold text-primary">
                                                    {{ number_format((float) $item->price, 2) }} DA
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Quantity --}}
                                        <td class="px-4 py-4">
                                            <form
                                                action="{{ route('cart.update') }}"
                                                method="POST"
                                                class="inline-block"
                                            >
                                                @csrf
                                                @method('PUT')

                                                <input
                                                    type="hidden"
                                                    name="rowId"
                                                    value="{{ $item->rowId }}"
                                                >

                                                <div class="flex w-max rounded border">
                                                    <button
                                                        type="button"
                                                        onclick="changeQuantity(this, -1)"
                                                        class="px-3 py-1 hover:bg-gray-100"
                                                        aria-label="Decrease quantity"
                                                    >
                                                        &minus;
                                                    </button>

                                                    <input
                                                        type="number"
                                                        name="quantity"
                                                        value="{{ $item->qty }}"
                                                        min="1"
                                                        readonly
                                                        class="w-12 text-center focus:outline-none"
                                                    >

                                                    <button
                                                        type="button"
                                                        onclick="changeQuantity(this, 1)"
                                                        class="px-3 py-1 hover:bg-gray-100"
                                                        aria-label="Increase quantity"
                                                    >
                                                        +
                                                    </button>
                                                </div>
                                            </form>
                                        </td>

                                        {{-- Item Subtotal --}}
                                        <td class="px-4 py-4 font-bold text-primary">
                                            {{ number_format((float) $item->subtotal, 2) }} DA
                                        </td>

                                        {{-- Remove Item --}}
                                        <td class="px-4 py-4">
                                            <form
                                                action="{{ route('cart.remove', $item->rowId) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-gray-400 transition hover:text-red-500"
                                                    aria-label="Remove {{ $item->name }}"
                                                    onclick="return confirm('Remove this product from your cart?')"
                                                >
                                                    <i class="fa-solid fa-trash-can text-xl"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Cart Actions --}}
                    <div class="mb-12 flex flex-col items-center justify-between gap-4 sm:flex-row">
                        <a
                            href="{{ route('shop.index') }}"
                            class="w-full rounded bg-sky-800 px-6 py-3 text-center text-white transition hover:bg-primary sm:w-auto"
                        >
                            Continue Shopping
                        </a>

                        <form
                            action="{{ route('cart.clear') }}"
                            method="POST"
                            class="w-full sm:w-auto"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Are you sure you want to clear your cart?')"
                                class="w-full rounded border border-gray-800 px-6 py-3 text-center text-gray-800 transition hover:bg-sky-800 hover:text-white sm:w-auto"
                            >
                                Clear Cart
                            </button>
                        </form>
                    </div>

                    {{-- Coupon and Totals --}}
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                        {{-- Coupon Form --}}
                        <div class="rounded border bg-gray-50 p-6 lg:col-span-2">
                            <h4 class="mb-2 text-lg font-bold">
                                Coupon Code
                            </h4>

                            <p class="mb-4 text-sm text-gray-500">
                                Enter your coupon code if you have one.
                            </p>

                            <form
                                class="space-y-4"
                                action="{{ route('cart.coupon.apply') }}"
                                method="POST"
                            >
                                @csrf

                                <input
                                    type="text"
                                    name="coupon_code"
                                    placeholder="Enter coupon code..."
                                    value="{{ old('coupon_code', $coupon['code'] ?? '') }}"
                                    required
                                    class="w-full rounded border p-3 uppercase focus:border-primary focus:outline-none"
                                >

                                <button
                                    type="submit"
                                    class="w-full rounded bg-sky-800 px-6 py-3 text-white transition hover:bg-primary"
                                >
                                    Apply Coupon
                                </button>
                            </form>

                            @if ($coupon)
                                <form
                                    action="{{ route('cart.coupon.remove') }}"
                                    method="POST"
                                    class="mt-3"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-sm font-medium text-red-600 hover:text-red-800"
                                    >
                                        Remove Coupon
                                    </button>
                                </form>
                            @endif
                        </div>

                        {{-- Cart Totals --}}
                        <div class="rounded border bg-gray-50 p-6">
                            <h4 class="mb-4 text-lg font-bold">
                                Cart Totals
                            </h4>

                            <div class="mb-6 space-y-4">

                                <div class="flex justify-between border-b pb-2">
                                    <span class="font-medium">Subtotal</span>

                                    <span class="font-bold">
                                        {{ number_format($cartSubtotal, 2) }} DA
                                    </span>
                                </div>

                                @if ($coupon)
                                    <div class="flex justify-between border-b pb-2 text-green-700">
                                        <span class="font-medium">
                                            Discount
                                            ({{ $coupon['code'] }})
                                        </span>

                                        <span class="font-bold">
                                            -{{ number_format($discountAmount, 2) }} DA
                                        </span>
                                    </div>
                                @endif

                                <div class="flex justify-between pt-2">
                                    <span class="text-lg font-bold">Total</span>

                                    <span class="text-lg font-bold text-primary">
                                        {{ number_format($finalTotal, 2) }} DA
                                    </span>
                                </div>
                            </div>

                            <a
                                href="{{ route('checkout') }}"
                                class="block w-full rounded bg-sky-800 px-6 py-3 text-center text-white transition hover:bg-primary"
                            >
                                Proceed To Checkout
                            </a>
                        </div>
                    </div>

                </div>

            @endif
        </div>
    </section>

    <script>
        function changeQuantity(button, change) {
            const form = button.closest('form');
            const input = form.querySelector('input[name="quantity"]');

            const currentQuantity = parseInt(input.value, 10) || 1;
            const newQuantity = Math.max(1, currentQuantity + change);

            if (newQuantity === currentQuantity) {
                return;
            }

            input.value = newQuantity;
            form.requestSubmit();
        }
    </script>
</x-app-layout>
