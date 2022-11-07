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
        Student::create([
            'first_name' => 'Francis Joseph',
            'middle_name' => 'Enriquez',
            'last_name' => 'Bernas',
            'birthdate' => '19960603',
            'gender' => 'male',
            'university' => 'Polytechnic University of the Philippines',
            'contact_number' => '09511929716',
            'email' => 'francis@user.com',
        ]);

        User::create([
            'email' => 'francis@user.com',
            'role' => 'student',
            'password' => Hash::make('wangan00'),
        ]);

        // =============================================================================

        Student::create([
            'first_name' => 'Ganyu',
            'middle_name' => 'Adepti',
            'last_name' => 'Sweet Rain',
            'birthdate' => '19230502',
            'gender' => 'female',
            'university' => 'University of Liyue',
            'contact_number' => '09277382901',
            'email' => 'ganyu@user.com',
        ]);

        User::create([
            'email' => 'ganyu@user.com',
            'role' => 'student',
            'password' => Hash::make('wangan00'),
        ]);
    }
}
