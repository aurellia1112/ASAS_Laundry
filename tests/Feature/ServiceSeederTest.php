<?php

namespace Tests\Feature;

use Database\Seeders\ServiceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_seeds_the_three_laundry_service_tiers_idempotently(): void
    {
        $this->seed(ServiceSeeder::class);
        $this->seed(ServiceSeeder::class);

        $this->assertDatabaseCount('services', 3);

        $this->assertDatabaseHas('services', [
            'service_name' => 'Reguler',
            'category' => 'Reguler',
            'price_per_unit' => 7000,
            'unit_type' => 'Kg',
            'description' => 'Layanan reguler dengan estimasi pengerjaan 3-4 hari.',
        ]);

        $this->assertDatabaseHas('services', [
            'service_name' => 'Ekspres',
            'category' => 'Express',
            'price_per_unit' => 12000,
            'unit_type' => 'Kg',
            'description' => 'Layanan ekspres dengan estimasi pengerjaan 1-2 hari.',
        ]);

        $this->assertDatabaseHas('services', [
            'service_name' => 'Superkilat',
            'category' => 'Superkilat',
            'price_per_unit' => 25000,
            'unit_type' => 'Kg',
            'description' => 'Layanan superkilat selesai dalam 5 jam.',
        ]);
    }
}
