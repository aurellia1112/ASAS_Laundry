<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Laundry - Laundry Aurel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>

<body class="bg-gradient-to-b from-blue-50/50 via-slate-50 to-slate-50 min-h-screen text-slate-800 p-4 sm:p-8">

    <div class="max-w-5xl mx-auto">

        {{-- TOP NAVIGATION BAR --}}
        <div class="bg-white/80 backdrop-blur-md rounded-2xl border border-slate-200/80 px-5 py-3 mb-8 shadow-xs flex flex-col sm:flex-row justify-between items-center gap-3">
            <a href="/" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-blue-600 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Halaman Utama
            </a>

            <div>
                @auth
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-medium text-slate-700 flex items-center gap-1.5">
                            <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-[10px]">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            {{ Auth::user()->name }}

                            @if(Auth::user()->role === \App\Models\User::ROLE_ADMIN)
                                <span class="ms-1 text-[11px] bg-blue-100 text-blue-700 font-bold px-2 py-0.5 rounded-full border border-blue-200">
                                    Admin
                                </span>
                            @else
                                <span class="ms-1 text-[11px] bg-slate-100 text-slate-700 font-bold px-2 py-0.5 rounded-full border border-slate-200">
                                    Pelanggan
                                </span>
                            @endif
                        </span>

                        @if(Auth::user()->role === \App\Models\User::ROLE_ADMIN)
                            <a href="{{ route('dashboard') }}" class="rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200 px-3 py-1.5 text-xs font-semibold transition">
                                Dashboard
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 border border-slate-200 px-3 py-1.5 text-xs font-semibold transition">
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}"
                            class="rounded-xl bg-blue-600 px-4 py-1.5 text-xs font-semibold text-white hover:bg-blue-700 shadow-xs transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="rounded-xl bg-slate-100 px-4 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-200 transition">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        {{-- HERO / HEADER --}}
        <div class="text-center mb-8">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 mb-3 border border-blue-200/60">
                <svg class="w-3.5 h-3.5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                Layanan Laundry Bersih & Higienis
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-800 tracking-tight">
                Laundry <span class="text-blue-600">Aurel</span>
            </h1>
            <p class="text-slate-500 text-sm mt-1.5 max-w-md mx-auto">
                Pilih paket laundry sesuai kebutuhan Anda, isi data diri, dan pakaian Anda akan kami jemput/proses dengan rapi.
            </p>
        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl mb-6 text-center font-semibold text-sm flex items-center justify-center gap-2 shadow-xs">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl mb-6 text-center font-semibold text-sm flex items-center justify-center gap-2 shadow-xs">
                <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl mb-6 font-semibold text-sm shadow-xs">
                <p class="font-bold mb-1 flex items-center gap-1.5 text-rose-700">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Mohon periksa kembali formulir Anda:
                </p>
                <ul class="list-disc list-inside text-xs space-y-0.5 ms-5 font-normal">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM PESANAN --}}
        <form id="orderForm" action="{{ route('customer.checkout') }}" method="POST">
            @csrf

            {{-- INFORMASI PELANGGAN --}}
            <div class="bg-white p-6 sm:p-7 rounded-2xl shadow-xs border border-slate-200/80 mb-8">
                <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100">
                    <span class="w-6 h-6 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center">1</span>
                    <h2 class="text-base font-bold text-slate-800">
                        Informasi Pelanggan
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="customer_name"
                            name="customer_name"
                            value="{{ old('customer_name', auth()->user()?->name) }}"
                            required
                            maxlength="255"
                            placeholder="Contoh: Budi Santoso"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition bg-slate-50/50 focus:bg-white">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nomor WhatsApp <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="whatsapp_number"
                            name="whatsapp_number"
                            value="{{ old('whatsapp_number') }}"
                            required
                            maxlength="20"
                            placeholder="Contoh: 081234567890"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition bg-slate-50/50 focus:bg-white">
                    </div>
                </div>
            </div>

            {{-- PILIH LAYANAN --}}
            <div class="flex items-center gap-2 mb-4">
                <span class="w-6 h-6 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center">2</span>
                <h2 class="text-base font-bold text-slate-800">
                    Pilih Paket Layanan
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                @forelse($services as $service)

                    <div class="service-card bg-white rounded-2xl shadow-xs hover:shadow-md border border-slate-200/80 hover:border-blue-300 transition-all duration-200 overflow-hidden flex flex-col justify-between group"
                        data-category="{{ $service->category ?? 'Reguler' }}">

                        <div>
                            @if($service->image)
                                <div class="overflow-hidden h-44 bg-slate-100">
                                    <img
                                        src="{{ asset('storage/' . $service->image) }}"
                                        alt="{{ $service->service_name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @else
                                <div class="h-32 bg-gradient-to-tr from-blue-50 to-sky-100 flex items-center justify-center text-blue-400">
                                    <svg class="w-12 h-12 stroke-[1.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-5">
                                <div class="flex justify-between items-center mb-2.5 gap-2">
                                    <span class="text-[11px] bg-blue-50 text-blue-700 font-bold px-2.5 py-0.5 rounded-full border border-blue-200">
                                        {{ $service->category ?? 'Reguler' }}
                                    </span>

                                    <span class="font-extrabold text-blue-700 text-sm">
                                        Rp {{ number_format($service->price_per_unit, 0, ',', '.') }}
                                        <span class="text-xs text-slate-400 font-normal">/ {{ $service->unit_type }}</span>
                                    </span>
                                </div>

                                <h3 class="font-bold text-slate-800 text-base group-hover:text-blue-600 transition-colors">
                                    {{ $service->service_name }}
                                </h3>

                                @if($service->description)
                                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">
                                        {{ $service->description }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- INPUT JUMLAH --}}
                        <div class="p-4 bg-slate-50/70 border-t border-slate-100">
                            <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5 text-center">
                                Masukkan Jumlah ({{ $service->unit_type }})
                            </label>

                            <input
                                type="hidden"
                                name="items[{{ $service->id }}][service_id]"
                                value="{{ $service->id }}">

                            <div class="flex items-center justify-center">
                                <input
                                    type="number"
                                    name="items[{{ $service->id }}][quantity]"
                                    min="0"
                                    step="1"
                                    value="{{ old('items.' . $service->id . '.quantity', 0) }}"
                                    data-name="{{ $service->service_name }}"
                                    data-price="{{ $service->price_per_unit }}"
                                    class="item-qty w-32 border border-slate-200 rounded-xl px-3 py-1.5 text-center font-extrabold text-base text-slate-800 bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition shadow-xs">
                            </div>
                        </div>

                    </div>

                @empty

                    <div class="col-span-3 text-center py-12 text-slate-400 bg-white rounded-2xl border border-slate-200/80">
                        <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        Belum ada paket layanan yang tersedia.
                    </div>

                @endforelse

            </div>

            {{-- TOMBOL PESAN SEKARANG --}}
            <div class="mt-8 flex justify-end">
                <button
                    type="button"
                    onclick="showConfirmationModal()"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold px-8 py-3.5 rounded-xl shadow-md shadow-blue-500/25 transition-all transform active:scale-95 cursor-pointer text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Pesan Sekarang
                </button>
            </div>

            {{-- MODAL KONFIRMASI --}}
            <div id="confirmModal"
                class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs hidden items-center justify-center z-50 p-4">

                <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 transform transition-all">

                    <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800 leading-tight">
                                Konfirmasi Pesanan
                            </h3>
                            <p class="text-xs text-slate-400">Pastikan detail pesanan Anda sudah benar</p>
                        </div>
                    </div>

                    <div class="space-y-2.5 text-xs text-slate-600 mb-4 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                        <div class="flex justify-between gap-3">
                            <span class="font-semibold text-slate-500">Nama Pelanggan:</span>
                            <span id="modalName" class="text-slate-900 font-bold text-right"></span>
                        </div>
                        <div class="flex justify-between gap-3">
                            <span class="font-semibold text-slate-500">WhatsApp:</span>
                            <span id="modalWhatsApp" class="text-slate-900 font-bold text-right"></span>
                        </div>
                    </div>

                    <div class="border-t border-b border-slate-100 py-3 mb-4 max-h-48 overflow-y-auto">
                        <p class="font-bold text-[11px] text-slate-400 uppercase tracking-wider mb-2">
                            Rincian Layanan Dipilih
                        </p>
                        <ul id="modalItemList" class="space-y-2 text-xs"></ul>
                    </div>

                    <div class="flex justify-between items-center bg-blue-50/70 p-3.5 rounded-xl border border-blue-100 mb-6">
                        <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Total Pembayaran:</span>
                        <span id="modalTotalPrice" class="text-blue-700 text-lg font-extrabold">
                            Rp 0
                        </span>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="button"
                            onclick="closeConfirmationModal()"
                            class="w-1/2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 rounded-xl transition text-xs cursor-pointer">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 rounded-xl shadow-md shadow-blue-500/20 transition text-xs cursor-pointer">
                            Ya, Kirim Pesanan
                        </button>
                    </div>

                </div>
            </div>

        </form>
    </div>

    {{-- JAVASCRIPT --}}
    <script>
        function formatCurrency(value) {
            return 'Rp ' + Number(value).toLocaleString('id-ID');
        }

        function showConfirmationModal() {
            const name = document.getElementById('customer_name').value.trim();
            const whatsapp = document.getElementById('whatsapp_number').value.trim();

            if (!name || !whatsapp) {
                alert('Nama dan nomor WhatsApp wajib diisi.');
                return;
            }

            const items = [];
            let total = 0;

            document.querySelectorAll('.item-qty').forEach(input => {
                const qty = Number(input.value || 0);

                if (!Number.isInteger(qty) || qty < 0) {
                    return;
                }

                if (qty > 0) {
                    const nameText = input.dataset.name;
                    const price = Number(input.dataset.price || 0);
                    const subtotal = qty * price;

                    items.push({
                        name: nameText,
                        qty: qty,
                        subtotal: subtotal
                    });

                    total += subtotal;
                }
            });

            if (items.length === 0) {
                alert('Pilih minimal satu layanan sebelum checkout.');
                return;
            }

            document.getElementById('modalName').textContent = name;
            document.getElementById('modalWhatsApp').textContent = whatsapp;

            const list = document.getElementById('modalItemList');
            list.replaceChildren();

            items.forEach(item => {
                const li = document.createElement('li');
                li.className = 'flex justify-between gap-3 py-1 border-b border-slate-100 last:border-b-0';

                const itemName = document.createElement('span');
                itemName.className = 'text-slate-700 font-medium';
                itemName.textContent = `${item.name} x ${item.qty}`;

                const itemPrice = document.createElement('span');
                itemPrice.className = 'font-bold text-slate-800';
                itemPrice.textContent = formatCurrency(item.subtotal);

                li.append(itemName, itemPrice);
                list.appendChild(li);
            });

            document.getElementById('modalTotalPrice').textContent = formatCurrency(total);

            document.getElementById('confirmModal').classList.remove('hidden');
            document.getElementById('confirmModal').classList.add('flex');
        }

        function closeConfirmationModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            document.getElementById('confirmModal').classList.remove('flex');
        }
    </script>

</body>
</html>
