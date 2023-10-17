<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $i = 0;
        while ($i < 20) {
            Student::create([
                'name' => Str::random(10),
                'parent_name' => Str::random(10),
                'phone' => $this->randomNumberSequence(),
                'address' => Str::random(15),
                'gender' => 1
            ]);
            $i++;
        }
    }
    function randomNumberSequence($requiredLength = 10, $highestDigit = 9) {
        $sequence = '';
        for ($i = 0; $i < $requiredLength; ++$i) {
            $sequence .= mt_rand(0, $highestDigit);
        }
        return $sequence;
    }

}
