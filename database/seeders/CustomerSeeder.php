<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'Ananda Rizki', 'email' => 'ananda@gmail.com'],
            ['name' => 'Affiyah Siti', 'email' => 'affiyah@gmail.com'],
            ['name' => 'Hapipah Yuni', 'email' => 'hapipah@gmail.com'],
            ['name' => 'Zahra Millan', 'email' => 'zahra@gmail.com'],
        ];

        foreach ($customers as $customerData) {
            $customer = User::updateOrCreate(
                ['email' => $customerData['email']],
                [
                    'name' => $customerData['name'],
                    'password' => 'password123',
                ],
            );

            $customer->role = User::ROLE_USER;
            $customer->email_verified_at = now();
            $customer->save();
        }
    }
}
