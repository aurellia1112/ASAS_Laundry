<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Services;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_reads_order_and_detail_tables(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $service = Services::create([
            'service_name' => 'Express',
            'category' => 'Express',
            'price_per_unit' => 12000,
            'unit_type' => 'Kg',
            'description' => null,
        ]);
        $order = Order::create([
            'customer_name' => 'Siti Aminah',
            'whatsapp_number' => '081298765432',
            'total_price' => 24000,
            'status' => Order::STATUS_PROSES,
        ]);
        $order->orderDetails()->create([
            'service_id' => $service->id,
            'quantity' => 2,
            'subtotal' => 24000,
        ]);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertOk();
        $response->assertViewHas('statusCounts', [
            'Proses' => 1,
            'Selesai' => 0,
        ]);
        $response->assertSee('Siti Aminah');
        $response->assertSee('Express');
        $response->assertSee('x2');
        $response->assertSee('Kg');
        $response->assertSee('Rp 24.000');
    }

    public function test_customer_can_open_laundry_page_with_database_services(): void
    {
        Services::create([
            'service_name' => 'Cuci Kilat',
            'category' => 'Express',
            'price_per_unit' => 12000,
            'unit_type' => 'Kg',
            'description' => 'Selesai dalam dua hari.',
        ]);

        $response = $this->get(route('customer.index'));

        $response->assertOk();
        $response->assertSee('Cuci Kilat');
        $response->assertSee('Rp 12.000');
    }

    public function test_customer_checkout_creates_order_and_calculates_total(): void
    {
        $service = Services::create([
            'service_name' => 'Reguler',
            'category' => 'Reguler',
            'price_per_unit' => 7000,
            'unit_type' => 'Kg',
            'description' => null,
        ]);

        $response = $this->post(route('customer.checkout'), [
            'customer_name' => 'Budi Santoso',
            'whatsapp_number' => '081234567890',
            'items' => [
                $service->id => [
                    'service_id' => $service->id,
                    'quantity' => 3,
                ],
            ],
        ]);

        $response->assertRedirect(route('customer.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Budi Santoso',
            'whatsapp_number' => '081234567890',
            'total_price' => 21000,
            'status' => 'Proses',
        ]);
        $this->assertDatabaseHas('order_details', [
            'service_id' => $service->id,
            'quantity' => 3,
            'subtotal' => 21000,
        ]);
    }
}
