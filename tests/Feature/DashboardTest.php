<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Daftar Pesanan Masuk');
    }

    public function test_regular_user_cannot_access_dashboard_and_is_redirected_to_customer(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);

        $response = $this->actingAs($user)->get('/dashboard');

        // User biasa diblokir dengan 403 Forbidden dan tidak bisa melihat rekapan admin
        $response->assertForbidden();
    }

    public function test_regular_user_cannot_access_services_crud(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);

        // User biasa dilarang mengakses kelola layanan (403 Forbidden)
        $response = $this->actingAs($user)->get('/services');
        $response->assertForbidden();

        $createResponse = $this->actingAs($user)->get('/services/create');
        $createResponse->assertForbidden();
    }

    public function test_regular_user_cannot_update_order_status(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);
        $order = Order::create([
            'customer_name' => 'John Doe',
            'whatsapp_number' => '08123456789',
            'total_price' => 50000,
            'status' => 'Proses',
        ]);

        $response = $this->actingAs($user)->patch(route('admin.orders.updateStatus', $order->id), [
            'status' => 'Selesai',
        ]);

        // User biasa dilarang mengubah status pesanan (403 Forbidden)
        $response->assertForbidden();
    }
}
