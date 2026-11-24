<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laundry Aurel') }} - Layanan Laundry Bersih, Cepat & Terpercaya</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-b from-blue-50/60 via-slate-50 to-white text-slate-800 font-sans antialiased min-h-screen flex flex-col justify-between">

        {{-- NAVIGATION HEADER --}}
        <header class="max-w-6xl w-full mx-auto px-4 sm:px-6 pt-6">
            <nav class="bg-white/80 backdrop-blur-md rounded-2xl border border-slate-200/80 px-5 py-3.5 shadow-xs flex justify-between items-center">
                <a href="/" class="flex items-center gap-2 transition hover:opacity-90">
                    <x-application-logo class="h-9 w-auto" />
                </a>

                <div class="flex items-center gap-3">
                    <a href="{{ route('customer.index') }}"
                       class="text-xs font-semibold text-slate-600 hover:text-blue-600 px-3 py-1.5 transition">
                        Pesan Laundry
                    </a>

                    @auth
                        @can('admin')
                            <a href="{{ url('/dashboard') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-sm shadow-blue-500/20 transition">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('customer.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-sm shadow-blue-500/20 transition">
                                Halaman Pesan
                            </a>
                        @endcan
                    @else
                        <a href="{{ route('login') }}"
                           class="text-xs font-semibold text-slate-700 hover:text-blue-600 px-3 py-1.5 transition">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-xl shadow-sm shadow-blue-500/20 transition">
                                Daftar Akun
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        </header>

        {{-- HERO SECTION --}}
        <main class="max-w-5xl mx-auto px-4 sm:px-6 py-12 sm:py-20 text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 mb-6 border border-blue-200/60">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                Solusi Cerdas Laundry Pakaian Anda
            </div>

            <h1 class="text-4xl sm:text-6xl font-extrabold text-slate-800 tracking-tight leading-tight">
                Pakaian Bersih, Wangi, &amp; Rapi<br class="hidden sm:inline" />
                Tanpa Ribet di <span class="text-blue-600">Laundry Aurel</span>
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Nikmati kemudahan mencuci pakaian dengan pilihan layanan kiloan dan satuan. Pesan langsung secara online dan pantau status pengerjaan secara real-time.
            </p>

        </main>

        {{-- FOOTER --}}
        <footer class="border-t border-slate-200/80 bg-white/60 py-6 text-center text-xs text-slate-400">
            <div class="max-w-5xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center gap-2">
                <div class="font-semibold text-slate-600">
                    Laundry <span class="text-blue-600">Aurel</span>
                </div>
                <div>
                    &copy; {{ date('Y') }} Laundry Aurel. Solusi Pakaian Bersih &amp; Rapi.
                </div>
            </div>
        </footer>

    </body>
</html>
