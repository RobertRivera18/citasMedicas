<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(BloodTypeSeeder::class);
        $this->call(SpecialitySeeder::class);
        $user = User::factory()->create([
            'name' => 'Robert Rivera',
            'email' => 'rxrc1819@gmail.com',
            'password' => bcrypt('1234567'),
            'cedula' => '2400335119',
            'phone' => '0997433070',
            'address' => 'Guillermo Cubillo y Ordanete'
        ]);
        $user->assignRole('Doctor');
        $user->doctor()->create();
    }
}
