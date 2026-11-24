<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'service_name' => 'Reguler',
                'category' => 'Reguler',
                'price_per_unit' => 7000,
                'unit_type' => 'Kg',
                'description' => 'Layanan reguler dengan estimasi pengerjaan 3-4 hari.',
            ],
            [
                'service_name' => 'Ekspres',
                'category' => 'Express',
                'price_per_unit' => 12000,
                'unit_type' => 'Kg',
                'description' => 'Layanan ekspres dengan estimasi pengerjaan 1-2 hari.',
            ],
            [
                'service_name' => 'Superkilat',
                'category' => 'Superkilat',
                'price_per_unit' => 25000,
                'unit_type' => 'Kg',
                'description' => 'Layanan superkilat selesai dalam 5 jam.',
            ],
        ];

        foreach ($services as $service) {
            Services::updateOrCreate(
                ['service_name' => $service['service_name']],
                $service,
            );
        }
    }
}
