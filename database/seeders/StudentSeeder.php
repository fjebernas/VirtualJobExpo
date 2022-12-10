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
            'about' => 'I am outgoing, dedicated, and open-minded. I get across to people and adjust to changes with ease. I believe that a person should work on developing their professional skills and learning new things all the time. Currently, I am looking for new career opportunities my current job position cannot provide.',
            'user_id' => '2',
        ]);

        // =============================================================================
    }
}
