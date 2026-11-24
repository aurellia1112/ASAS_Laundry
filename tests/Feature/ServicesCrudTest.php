<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Services;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ServicesCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
    }

    public function test_admin_can_read_services_index(): void
    {
        $service = Services::create([
            'service_name' => 'Cuci Lipat Reguler',
            'category' => 'Reguler',
            'price_per_unit' => 7000,
            'unit_type' => 'Kg',
            'description' => 'Selesai dalam 3 hari',
        ]);

        $response = $this->actingAs($this->admin)->get(route('services.index'));

        $response->assertOk();
        $response->assertSee('Cuci Lipat Reguler');
        $response->assertSee('Rp 7.000');
    }

    public function test_admin_can_create_service_without_image(): void
    {
        $response = $this->actingAs($this->admin)->post(route('services.store'), [
            'service_name' => 'Cuci Kering Express',
            'category' => 'Express',
            'price_per_unit' => 12000,
            'unit_type' => 'Kg',
            'description' => 'Selesai 1 hari kerja',
        ]);

        $response->assertRedirect(route('services.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('services', [
            'service_name' => 'Cuci Kering Express',
            'category' => 'Express',
            'price_per_unit' => 12000,
            'unit_type' => 'Kg',
        ]);
    }

    public function test_admin_can_create_service_with_image(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('service.jpg');

        $response = $this->actingAs($this->admin)->post(route('services.store'), [
            'service_name' => 'Cuci Bedcover Super',
            'category' => 'Superkilat',
            'price_per_unit' => 25000,
            'unit_type' => 'Pcs',
            'description' => 'Khusus selimut dan bedcover',
            'image' => $file,
        ]);

        $response->assertRedirect(route('services.index'));

        $service = Services::where('service_name', 'Cuci Bedcover Super')->first();
        $this->assertNotNull($service);
        $this->assertNotNull($service->image);
        Storage::disk('public')->assertExists($service->image);
    }

    public function test_admin_can_update_service(): void
    {
        $service = Services::create([
            'service_name' => 'Cuci Karpet',
            'category' => 'Reguler',
            'price_per_unit' => 15000,
            'unit_type' => 'Pcs',
            'description' => 'Sebelum diubah',
        ]);

        $response = $this->actingAs($this->admin)->put(route('services.update', $service->id), [
            'service_name' => 'Cuci Karpet Tebal Premium',
            'category' => 'Superkilat',
            'price_per_unit' => 30000,
            'unit_type' => 'Pcs',
            'description' => 'Sudah diperbarui dengan vacuum wash',
        ]);

        $response->assertRedirect(route('services.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'service_name' => 'Cuci Karpet Tebal Premium',
            'category' => 'Superkilat',
            'price_per_unit' => 30000,
        ]);
    }

    public function test_admin_can_delete_service(): void
    {
        $service = Services::create([
            'service_name' => 'Layanan Mau Dihapus',
            'category' => 'Reguler',
            'price_per_unit' => 5000,
            'unit_type' => 'Kg',
        ]);

        $response = $this->actingAs($this->admin)->delete(route('services.destroy', $service->id));

        $response->assertRedirect(route('services.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }

    public function test_admin_can_update_order_status(): void
    {
        $order = Order::create([
            'customer_name' => 'Pak Joko',
            'whatsapp_number' => '089988776655',
            'total_price' => 35000,
            'status' => 'Proses',
        ]);

        $response = $this->actingAs($this->admin)->patch(route('admin.orders.updateStatus', $order->id), [
            'status' => 'Selesai',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'Selesai',
        ]);
    }
}
