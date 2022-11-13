<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'francis@user.com',
            'role' => 'student',
            'password' => Hash::make('wangan00'),
        ]);

        Student::create([
            'first_name' => 'Francis Joseph',
            'middle_name' => 'Enriquez',
            'last_name' => 'Bernas',
            'birthdate' => '19960603',
            'gender' => 'male',
            'university' => 'Polytechnic University of the Philippines',
            'contact_number' => '09511929716',
            'user_id' => '1',
        ]);

        // =============================================================================
    }
}
