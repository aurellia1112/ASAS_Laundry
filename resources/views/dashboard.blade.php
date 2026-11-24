<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-100 text-blue-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </span>
                    <h2 class="font-bold text-xl text-slate-800 leading-tight">
                        {{ __('Daftar Pesanan Masuk') }}
                    </h2>
                </div>
                <p class="text-xs text-slate-500 mt-0.5 ms-10">Pantau dan kelola antrean status pesanan laundry pelanggan</p>
            </div>

            <div class="flex items-center gap-2.5 flex-wrap">
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-600 rounded-xl text-xs text-white font-semibold uppercase tracking-wider hover:bg-blue-700 active:bg-blue-800 shadow-sm transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    Kelola Layanan
                </a>

                <a href="{{ route('customer.index') }}" target="_blank"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white rounded-xl text-xs text-slate-700 font-semibold uppercase tracking-wider hover:bg-slate-50 border border-slate-200 shadow-xs transition">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Halaman Pelanggan
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-rose-50 text-rose-600 border border-rose-200 rounded-xl text-xs font-semibold uppercase tracking-wider hover:bg-rose-100 transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3 shadow-xs">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Statistik Pesanan --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">

                {{-- Total Pesanan --}}
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pesanan</p>
                        <p class="text-2xl font-extrabold text-slate-800 mt-1">
                            {{ count($orders) }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>

                {{-- Status Proses --}}
                <div class="bg-white p-5 rounded-2xl border border-blue-100 shadow-xs flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-blue-600 uppercase tracking-wider">Proses</p>
                        <p class="text-2xl font-extrabold text-blue-700 mt-1">
                            {{ $statusCounts['Proses'] ?? 0 }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Status Selesai --}}
                <div class="bg-white p-5 rounded-2xl border border-emerald-100 shadow-xs flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Selesai</p>
                        <p class="text-2xl font-extrabold text-emerald-700 mt-1">
                            {{ $statusCounts['Selesai'] ?? 0 }}
                        </p>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

            </div>

            {{-- Tabel Pesanan --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-white">
                    <div>
                        <h3 class="font-bold text-slate-800 text-base">Antrean Pesanan Masuk</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Daftar transaksi laundry terbaru yang perlu diproses</p>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg">
                        {{ count($orders) }} Transaksi
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/80 text-slate-500 uppercase text-[11px] font-semibold tracking-wider border-b border-slate-200/80">
                            <tr>
                                <th class="py-3.5 px-4"># ID</th>
                                <th class="py-3.5 px-4">Tanggal</th>
                                <th class="py-3.5 px-4">Pelanggan</th>
                                <th class="py-3.5 px-4">Nomor WhatsApp</th>
                                <th class="py-3.5 px-4">Jenis Layanan</th>
                                <th class="py-3.5 px-4">Total Harga</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-4 text-center">Aksi Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 text-sm">

                            @forelse($orders as $order)
                                <tr class="hover:bg-blue-50/30 transition-colors">

                                    {{-- ID --}}
                                    <td class="py-4 px-4 font-mono font-bold text-blue-700 text-xs">
                                        <span class="inline-block px-2 py-1 bg-blue-50 rounded-lg border border-blue-100">
                                            #{{ $order->id }}
                                        </span>
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="py-4 px-4 text-slate-600 whitespace-nowrap text-xs">
                                        <div class="font-medium text-slate-800">
                                            {{ $order->created_at?->format('d/m/Y') ?? '-' }}
                                        </div>
                                        <div class="text-[11px] text-slate-400">
                                            {{ $order->created_at?->format('H:i') ?? '' }} WIB
                                        </div>
                                    </td>

                                    {{-- Pelanggan --}}
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs">
                                                {{ strtoupper(substr($order->customer_name, 0, 1)) }}
                                            </div>
                                            <span class="font-semibold text-slate-800">
                                                {{ $order->customer_name }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- WhatsApp --}}
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->whatsapp_number) }}" target="_blank"
                                           class="inline-flex items-center gap-1.5 text-xs text-slate-600 hover:text-emerald-600 font-medium transition">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                            {{ $order->whatsapp_number }}
                                        </a>
                                    </td>

                                    {{-- Detail Layanan --}}
                                    <td class="py-4 px-4 min-w-[220px]">
                                        <ul class="space-y-1.5 text-xs text-slate-600">
                                            @foreach($order->orderDetails as $detail)
                                                <li class="flex items-start gap-1.5 bg-slate-50 p-1.5 rounded-lg border border-slate-100">
                                                    <span class="text-blue-500 font-bold">•</span>
                                                    <div class="flex-1">
                                                        <span class="font-bold text-slate-800">
                                                            {{ $detail->service->service_name ?? 'Layanan tidak tersedia' }}
                                                        </span>
                                                        <span class="text-slate-500 font-semibold ms-1">
                                                            x{{ $detail->quantity }} {{ $detail->service->unit_type ?? '' }}
                                                        </span>
                                                        <span class="text-slate-400 text-[11px] ms-1">
                                                            (Rp {{ number_format($detail->subtotal, 0, ',', '.') }})
                                                        </span>
                                                    </div>
                                                </li>
                                            @endforeach

                                            @if($order->orderDetails->isEmpty())
                                                <li class="text-slate-400 italic">
                                                    Tidak ada detail layanan
                                                </li>
                                            @endif
                                        </ul>
                                    </td>

                                    {{-- Total Harga --}}
                                    <td class="py-4 px-4 font-extrabold text-blue-700 whitespace-nowrap text-sm">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        @if($order->status === 'Proses')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                                                PROSES
                                            </span>
                                        @elseif($order->status === 'Selesai')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                                SELESAI
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                                {{ strtoupper($order->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Ubah Status --}}
                                    <td class="py-4 px-4 text-center whitespace-nowrap">
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <select name="status"
                                                onchange="this.form.submit()"
                                                class="text-xs border border-slate-300 rounded-xl px-3 py-1.5 bg-white shadow-xs font-semibold text-slate-700 hover:border-blue-400 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition cursor-pointer">
                                                <option value="Proses" {{ $order->status === 'Proses' ? 'selected' : '' }}>
                                                    Proses
                                                </option>
                                                <option value="Selesai" {{ $order->status === 'Selesai' ? 'selected' : '' }}>
                                                    Selesai
                                                </option>
                                            </select>
                                        </form>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="p-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center mb-3">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                            </div>
                                            <p class="font-bold text-slate-700 text-sm">Belum ada pesanan masuk.</p>
                                            <p class="text-xs text-slate-400 mt-1">Pesanan yang dibuat oleh pelanggan akan otomatis muncul di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
