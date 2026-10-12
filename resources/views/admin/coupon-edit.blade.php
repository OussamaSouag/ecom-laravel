<x-admin-layout>
     <main class="flex-1 overflow-y-auto p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-white">Edit Coupon</h1>
                    <a href="{{ route('admin.coupons') }}" class="border border-white/10 bg-[#0f172a] hover:bg-[#1e293b] text-slate-200 px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i> Back to Coupons
                    </a>
                </div>
                
                <div class="max-w-3xl mx-auto">
                    <form action="{{ route('admin.coupon.update',$coupon->id) }}" method="POST" class="bg-[#0f172a] rounded-xl shadow-sm border border-white/10 p-8 space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Coupon Code *</label>
                                <input type="text" id="code" name="code" value="{{ old('code', $coupon->code) }}" placeholder="e.g. SUMMER20" required class="w-full bg-[#020617] border border-white/10 text-white placeholder-slate-500 px-4 py-2 rounded-lg outline-none focus:ring-1 focus:ring-blue-600 uppercase">
                                <p class="text-xs text-slate-500 mt-1">Must be unique.</p>
                                @error('code')
                                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Discount Type *</label>
                                <select id="type" name="type" required class="w-full bg-[#020617] border border-white/10 text-white px-4 py-2 rounded-lg outline-none focus:ring-1 focus:ring-blue-600">
                                    <option value="percent" {{ old('type', $coupon->type) == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                                    <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                </select>
                                @error('type')
                                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Discount Value *</label>
                                <input type="number" step="0.01" id="value" name="value" value="{{ old('value', $coupon->value) }}" placeholder="e.g. 20" required class="w-full bg-[#020617] border border-white/10 text-white placeholder-slate-500 px-4 py-2 rounded-lg outline-none focus:ring-1 focus:ring-blue-600">
                                @error('value')
                                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Minimum Cart Value *</label>
                                <input type="number" step="0.01" id="cart_value" name="cart_value" value="{{ old('cart_value', $coupon->cart_value) }}" placeholder="e.g. 100" required class="w-full bg-[#020617] border border-white/10 text-white placeholder-slate-500 px-4 py-2 rounded-lg outline-none focus:ring-1 focus:ring-blue-600">
                                @error('cart_value')
                                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Expiry Date *</label>
                                <input type="date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $coupon->expiry_date) }}" required class="w-full bg-[#020617] border border-white/10 text-white px-4 py-2 rounded-lg outline-none focus:ring-1 focus:ring-blue-600">
                                @error('expiry_date')
                                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                            <a href="{{ route('admin.coupons') }}" class="px-6 py-2 border border-white/10 text-slate-300 rounded-lg hover:bg-white/5 transition text-sm">Cancel</a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition text-sm font-medium shadow-sm">Update Coupon</button>
                        </div>
                    </form>
                </div>
            </main>
</x-admin-layout>