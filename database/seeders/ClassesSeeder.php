<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $i = 0;
        while ($i < 20) {
            Classes::create([
                'teacher_id' => 1,
                'name' => Str::random(10),
                'sku' => Str::random(10),
                'tuition_fee' => 40000,
                'description' => Str::random(15),
                'status' => 1
            ]);
            $i++;
        }
    }
}
