<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Robert Rivera',
            'email' => 'rxrc1819@gmail.com',
            'password' => bcrypt('12345678'),
            'cedula' => '2400335119',
            'phone' => '0997433070',
            'address' => 'Calle Falsa 123',
        ]);

        $user->assignRole('Admin');
        $user->doctor()->create();
    }
}
