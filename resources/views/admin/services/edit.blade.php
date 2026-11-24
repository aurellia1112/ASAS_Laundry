<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h2 class="font-bold text-xl text-slate-800 leading-tight">
                    {{ __('Edit Paket / Tarif Layanan') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Perbarui rincian informasi tarif atau foto paket laundry</p>
            </div>
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-blue-600 px-3 py-1.5 rounded-lg border border-slate-200 bg-white shadow-xs transition">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Layanan
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-xs">
                <p class="font-bold text-sm mb-1">Terjadi kesalahan input:</p>
                <ul class="list-disc list-inside text-xs space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 sm:p-8 rounded-2xl shadow-xs border border-slate-200/80 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Nama Layanan <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="service_name" value="{{ old('service_name', $service->service_name) }}"
                       class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition" required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kategori <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition bg-white" required>
                        <option value="Reguler" {{ old('category', $service->category) === 'Reguler' ? 'selected' : '' }}>Reguler</option>
                        <option value="Express" {{ old('category', $service->category) === 'Express' ? 'selected' : '' }}>Express</option>
                        <option value="Superkilat" {{ old('category', $service->category) === 'Superkilat' ? 'selected' : '' }}>Superkilat</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Tipe Unit <span class="text-rose-500">*</span>
                    </label>
                    <select name="unit_type" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition bg-white" required>
                        <option value="Kg" {{ old('unit_type', $service->unit_type) === 'Kg' ? 'selected' : '' }}>Kg (Kilogram)</option>
                        <option value="Pcs" {{ old('unit_type', $service->unit_type) === 'Pcs' ? 'selected' : '' }}>Pcs (Satuan)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Harga per Unit (Rp) <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 start-0 flex items-center ps-4 text-xs font-bold text-slate-400">Rp</span>
                    <input type="number" name="price_per_unit" value="{{ old('price_per_unit', $service->price_per_unit) }}"
                           class="w-full border border-slate-200 rounded-xl ps-11 pe-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition font-semibold" min="1" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Deskripsi Layanan (Opsional)
                </label>
                <textarea name="description" rows="3"
                          class="w-full border border-slate-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition">{{ old('description', $service->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Foto / Gambar Layanan
                </label>
                @if ($service->image)
                    <div class="mb-3 flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <img src="{{ asset('storage/' . $service->image) }}" class="w-16 h-16 object-cover rounded-lg border border-slate-200 shadow-xs">
                        <div class="text-xs text-slate-500">
                            <p class="font-semibold text-slate-700">Gambar saat ini</p>
                            <p class="text-[11px] text-slate-400">Pilih file baru di bawah jika ingin mengganti gambar.</p>
                        </div>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full text-xs text-slate-500 file:me-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            </div>

            <div class="pt-3 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('services.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl font-bold text-xs shadow-sm shadow-blue-500/20 transition cursor-pointer">
                    Perbarui Layanan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
