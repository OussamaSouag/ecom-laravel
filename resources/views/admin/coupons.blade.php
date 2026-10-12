<x-admin-layout>
      <main class="flex-1 overflow-y-auto p-6 bg-[#020617]">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-white">Coupons</h1>
                        <p class="text-sm text-slate-400">Manage discount codes and promotional offers</p>
                    </div>
                    <a href="{{ route('admin.coupon.add') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2 shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add New Coupon
                    </a>
                </div>

                <div class="bg-[#0f172a] p-4 rounded-xl shadow-sm border border-white/10 mb-6">
                    <div class="flex flex-col md:flex-row gap-4 justify-between">
                        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                            <div class="relative w-full md:w-64">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fa-solid fa-search text-slate-500"></i>
                                </span>
                                <input type="text" class="w-full pl-10 pr-4 py-2 bg-[#020617] border border-white/10 rounded-lg text-sm text-white placeholder-slate-500 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600" placeholder="Search coupon code...">
                            </div>

                            <select class="w-full md:w-40 bg-[#020617] border border-white/10 px-3 py-2 rounded-lg text-sm focus:outline-none focus:border-blue-600 text-slate-300">
                                <option value="">All Types</option>
                                <option value="fixed">Fixed</option>
                                <option value="percent">Percent</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-[#0f172a] rounded-xl shadow-sm border border-white/10 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="bg-[#020617] text-slate-400 text-xs uppercase font-semibold">
                                <tr>
                                    <th class="px-6 py-4">ID</th>
                                    <th class="px-6 py-4">Code</th>
                                    <th class="px-6 py-4">Type</th>
                                    <th class="px-6 py-4">Value</th>
                                    <th class="px-6 py-4">Min. Cart Value</th>
                                    <th class="px-6 py-4">Expiry Date</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @forelse ($coupons as $coupon)                             
                                <tr class="hover:bg-white/5 transition">
                                    <td class="px-6 py-4 text-sm text-slate-400">{{ $coupon->id }}</td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-white tracking-wider">{{ $coupon->code }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-purple-500/10 text-purple-400 px-2 py-1 rounded text-xs font-semibold uppercase">{{ $coupon->type }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-white">
                                    @if($coupon->type === 'percent')
                                    
                                   {{ $coupon->value }} %
                                @else
                                 {{ $coupon->value  }} DA
                                 @endif
                                

                                     </td>
                                    <td class="px-6 py-4 text-sm text-slate-400">{{ $coupon->cart_value }} DA</td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-slate-400"><i class="fa-regular fa-calendar mr-1"></i> {{ $coupon->expiry_date }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.coupon.edit',$coupon->id) }}" class="w-8 h-8 rounded-full hover:bg-white/5 text-blue-400 transition flex items-center justify-center" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.coupon.destroy',$coupon->id) }}">
                                                @method('DELETE')
                                            <button class="w-8 h-8 rounded-full hover:bg-white/5 text-red-400 transition flex items-center justify-center" onclick="deleteCoupon(this, '{{ $coupon->code }}', {{ $coupon->id }})" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-slate-500">
                                            <i class="fa-solid fa-ticket text-4xl mb-3 text-slate-700"></i>
                                            <h3 class="text-lg font-medium text-white">No coupons available</h3>
                                            <p class="text-sm mt-1">You haven't created any discount codes yet.</p>
                                            <a href="{{ route('admin.coupon.add') }}" class="mt-4 text-blue-400 hover:underline text-sm font-medium">
                                                Create your first coupon
                                            </a>
                                        </div>
                                    </td>
                                </tr> @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-sm text-slate-400">Showing <span class="font-bold text-slate-200">1-2</span> of <span class="font-bold text-slate-200">2</span> coupons</span>

                        <div class="flex gap-2">
                            <button class="px-3 py-1 border border-white/10 rounded hover:bg-white/5 text-slate-400 disabled:opacity-50 text-sm" disabled>Previous</button>
                            <button class="px-3 py-1 border border-blue-600 rounded bg-blue-600 text-white text-sm">1</button>
                            <button class="px-3 py-1 border border-white/10 rounded hover:bg-white/5 text-slate-400 disabled:opacity-50 text-sm" disabled>Next</button>
                        </div>
                    </div>
                </div>

            </main>
</x-admin-layout>