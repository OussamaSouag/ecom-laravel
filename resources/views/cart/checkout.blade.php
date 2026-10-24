<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            <a href="{{ route('shop.index') }}"
               class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700">
                &larr; Continue shopping
            </a>

            <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-6 sm:px-8">
                    <h1 class="text-2xl font-bold text-slate-900">
                        Checkout
                    </h1>
                    <p class="mt-2 text-sm text-slate-500">
                        Enter your contact and delivery information.
                    </p>
                </div>

                @if (session('success'))
                    <div class="mx-6 mt-6 rounded-xl bg-green-50 p-4 text-sm text-green-700 sm:mx-8">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-700">
        <p class="font-semibold">Please fix the following errors:</p>

        <ul class="mt-2 list-inside list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- {{ route('checkout.store') }} --}}

                <form action="{{ route('order.store') }}" method="POST"
                      class="space-y-6 p-6 sm:p-8">
                    @csrf

                    {{-- Full name --}}
                    <div>
                        <label for="name"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Full name
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            required
                            maxlength="255"
                            placeholder="Enter your full name"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10"
                        >

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Phone number
                        </label>

                        <input
                            id="phone"
                            name="number"
                            type="tel"
                            value="{{ old('phone') }}"
                            autocomplete="tel"
                            inputmode="tel"
                            required
                            maxlength="20"
                            placeholder="0XXXXXXXXX"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10"
                        >

                        @error('phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Wilaya --}}
                    <div>
                        <label for="wilaya"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Wilaya
                        </label>

                        <select
                            id="wilaya"
                            name="wilaya"
                            required
                            data-url="{{ asset('data/wilayas.json') }}"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10"
                        >
                            <option value="">Loading wilayas...</option>
                        </select>

                        @error('wilaya')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Commune --}}
                    <div>
                        <label for="commune"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Commune
                        </label>

                        <select
                            id="commune"
                            name="commune"
                            required
                            disabled
                            data-url="{{ asset('data/communes.json') }}"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10 disabled:cursor-not-allowed disabled:bg-slate-50"
                        >
                            <option value="">Choose your wilaya first</option>
                        </select>

                        @error('commune')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Delivery address --}}
                    <div>
                        <label for="address"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Delivery address
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            autocomplete="street-address"
                            required
                            maxlength="1000"
                            placeholder="Street, building, apartment, additional details..."
                            class="w-full resize-y rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10"
                        >{{ old('address') }}</textarea>

                        @error('address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        id="checkout-submit"
                        type="submit"
                        class="w-full rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/20"
                    >
                        Continue
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const wilayaSelect = document.getElementById('wilaya');
            const communeSelect = document.getElementById('commune');
            const submitButton = document.getElementById('checkout-submit');

            const oldWilaya = @json(old('wilaya'));
            const oldCommune = @json(old('commune'));

            const isArabic = false; // Change to true to display Arabic names.

            function getName(item) {
                return isArabic && item.ar_name
                    ? item.ar_name
                    : item.name;
            }

            function setPlaceholder(select, message) {
                select.replaceChildren(new Option(message, ''));
            }

            try {
                const [wilayaResponse, communeResponse] = await Promise.all([
                    fetch(wilayaSelect.dataset.url),
                    fetch(communeSelect.dataset.url)
                ]);

                if (!wilayaResponse.ok || !communeResponse.ok) {
                    throw new Error('Unable to load the location JSON files.');
                }

                const [wilayaText, communeText] = await Promise.all([
                    wilayaResponse.text(),
                    communeResponse.text()
                ]);

                // Remove a possible UTF-8 BOM before parsing.
                const wilayas = JSON.parse(wilayaText.replace(/^\uFEFF/, ''));
                const communes = JSON.parse(communeText.replace(/^\uFEFF/, ''));

                if (!Array.isArray(wilayas) || !Array.isArray(communes)) {
                    throw new Error('The location files must contain JSON arrays.');
                }

                wilayas.sort((a, b) => Number(a.code) - Number(b.code));

                setPlaceholder(wilayaSelect, 'Choose your wilaya');

                wilayas.forEach(wilaya => {
                    wilayaSelect.add(new Option(
                        `${String(wilaya.code).padStart(2, '0')} - ${getName(wilaya)}`,
                        String(wilaya.id)
                    ));
                });

                function updateCommunes(wilayaId, selectedCommune = '') {
                    setPlaceholder(communeSelect, 'Choose your commune');

                    const filteredCommunes = communes
                        .filter(commune =>
                            String(commune.wilaya_id) === String(wilayaId)
                        )
                        .sort((a, b) =>
                            getName(a).localeCompare(getName(b))
                        );

                    filteredCommunes.forEach(commune => {
                        communeSelect.add(new Option(
                            getName(commune),
                            String(commune.id)
                        ));
                    });

                    communeSelect.disabled = filteredCommunes.length === 0;

                    if (filteredCommunes.length === 0) {
                        setPlaceholder(communeSelect, 'No communes available');
                    }

                    communeSelect.value = String(selectedCommune || '');
                }

                wilayaSelect.addEventListener('change', () => {
                    updateCommunes(wilayaSelect.value);
                });

                if (oldWilaya) {
                    wilayaSelect.value = String(oldWilaya);
                    updateCommunes(oldWilaya, oldCommune);
                }

                // Prevent submission before location data has loaded.
                submitButton.disabled = false;
            } catch (error) {
                console.error('Location data error:', error);

                setPlaceholder(wilayaSelect, 'Unable to load wilayas');
                setPlaceholder(communeSelect, 'Unable to load communes');

                communeSelect.disabled = true;
                submitButton.disabled = true;

                submitButton.classList.add('cursor-not-allowed', 'opacity-50');
            }
        });
    </script>
</x-app-layout>