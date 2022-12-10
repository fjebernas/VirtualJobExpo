<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'se@company.com',
            'role' => 'company',
            'password' => Hash::make('wangan00'),
        ]);

        Company::create([
            'name' => 'SE Company',
            'industry' => 'IT/Web development',
            'address' => 'Address 123 Blg. ABC St. Metro Manila',
            'contact_number' => '09274927678',
            'about' => 'Our dedicated team of developers are passionate about helping people, and build and grow their online business. Since our founding in 2010, SE Company has enabled 1000+ content creators around the world to build and grow their online business.',
            'user_id' => '3',
        ]);

        Company::factory()->count(200)->hasJobPosts(2)->create();
    }
}
