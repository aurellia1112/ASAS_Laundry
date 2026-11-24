<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Services;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman pelanggan.
     */
    public function index(): View
    {
        $services = Services::query()
            ->orderBy('service_name')
            ->get();

        return view('customer.index', compact('services'));
    }

    /**
     * Menyimpan pesanan pelanggan.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:services,id',
            'items.*.quantity' => 'required|integer|min:0',
        ]);

        $items = collect($validated['items'])
            ->filter(fn (array $item): bool => $item['quantity'] > 0);

        if ($items->isEmpty()) {
            throw ValidationException::withMessages([
                'items' => 'Pilih minimal satu layanan dengan jumlah lebih dari nol.',
            ]);
        }

        DB::transaction(function () use ($validated, $items): void {

            $serviceIds = $items->pluck('service_id')->unique();

            $services = Services::query()
                ->whereKey($serviceIds->all())
                ->get()
                ->keyBy('id');

            if ($services->count() !== $serviceIds->count()) {
                throw (new ModelNotFoundException)
                    ->setModel(Services::class, $serviceIds->all());
            }

            // Membuat pesanan baru
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'whatsapp_number' => $validated['whatsapp_number'],
                'total_price' => 0,
                'status' => 'Proses',
            ]);

            $totalPrice = 0;

            // Menyimpan detail pesanan
            foreach ($items as $item) {

                $service = $services->get($item['service_id']);

                if ($service === null) {
                    throw (new ModelNotFoundException)
                        ->setModel(Services::class, [$item['service_id']]);
                }

                $subtotal = $service->price_per_unit * $item['quantity'];

                $order->orderDetails()->create([
                    'service_id' => $service->id,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ]);

                $totalPrice += $subtotal;
            }

            // Memperbarui total harga
            $order->update([
                'total_price' => $totalPrice,
            ]);
        });

        return redirect()
            ->route('customer.index')
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Menampilkan dashboard admin.
     */
    public function adminDashboard(): View|RedirectResponse
    {
        // Proteksi khusus admin: pengguna biasa diarahkan ke halaman pemesanan pelanggan
        if (request()->user()?->role !== User::ROLE_ADMIN) {
            return redirect()
                ->route('customer.index')
                ->with('error', 'Akses ditolak. Halaman rekapan pesanan dan dashboard hanya khusus untuk Administrator.');
        }

        $orders = Order::with('orderDetails.service')
            ->latest()
            ->get();

        // Menghitung jumlah pesanan berdasarkan status
        $statusCounts = [
            'Proses' => $orders->where('status', Order::STATUS_PROSES)->count(),
            'Selesai' => $orders->where('status', Order::STATUS_SELESAI)->count(),
        ];

        return view('dashboard', compact('orders', 'statusCounts'));
    }

    /**
     * Memperbarui status pesanan.
     */
    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:Proses,Selesai',
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
