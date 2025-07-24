<?php

namespace Database\Seeders;

use App\Models\Speciality;
use App\Models\Specility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialities = [
            'Cardiología',
            'Dermatología',
            'Endocrinología',
            'Gastroenterología',
            'Geriatría',
            'Ginecología',
            'Hematología',
            'Infectología',
        ];
        foreach ($specialities as $speciality) {
            Speciality::create(['name' => $speciality]);
        }
    }
}
