<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-100 text-blue-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </span>
                    <h2 class="font-bold text-xl text-slate-800 leading-tight">
                        {{ __('Daftar Paket & Tarif Layanan') }}
                    </h2>
                </div>
                <p class="text-xs text-slate-500 mt-0.5 ms-10">Kelola paket laundry, harga per unit, dan kategori layanan</p>
            </div>

            <div class="flex items-center gap-2.5 flex-wrap">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-blue-600 rounded-xl text-xs text-white font-semibold uppercase tracking-wider hover:bg-blue-700 active:bg-blue-800 shadow-sm transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard Pesanan
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
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Action & Alerts --}}
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('services.create') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Service
                </a>
            </div>

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

            {{-- Table Card --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/80 text-slate-500 uppercase text-[11px] font-semibold tracking-wider border-b border-slate-200/80">
                            <tr>
                                <th class="py-3.5 px-5 text-center w-24">Gambar</th>
                                <th class="py-3.5 px-5">Nama Layanan</th>
                                <th class="py-3.5 px-5">Kategori</th>
                                <th class="py-3.5 px-5">Harga per Unit</th>
                                <th class="py-3.5 px-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($services as $service)
                                <tr class="hover:bg-blue-50/30 transition-colors">
                                    {{-- Gambar --}}
                                    <td class="py-3.5 px-5 text-center">
                                        @if($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}" class="w-14 h-14 object-cover mx-auto rounded-xl border border-slate-200 shadow-xs">
                                        @else
                                            <div class="w-14 h-14 bg-slate-100 rounded-xl mx-auto flex items-center justify-center text-slate-400 border border-slate-200 text-[10px] font-semibold">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Nama --}}
                                    <td class="py-3.5 px-5">
                                        <div class="font-bold text-slate-800 text-sm">{{ $service->service_name }}</div>
                                        @if($service->description)
                                            <div class="text-xs text-slate-400 mt-0.5 line-clamp-1">{{ $service->description }}</div>
                                        @endif
                                    </td>

                                    {{-- Kategori --}}
                                    <td class="py-3.5 px-5">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                            {{ $service->category }}
                                        </span>
                                    </td>

                                    {{-- Harga --}}
                                    <td class="py-3.5 px-5 font-extrabold text-blue-700 whitespace-nowrap">
                                        Rp {{ number_format($service->price_per_unit, 0, ',', '.') }}
                                        <span class="text-xs font-normal text-slate-400">/ {{ $service->unit_type }}</span>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="py-3.5 px-5 text-center whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('services.edit', $service->id) }}"
                                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 font-semibold text-xs transition">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')"
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 font-semibold text-xs transition cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-slate-400">
                                        Belum ada layanan yang ditambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $services->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
