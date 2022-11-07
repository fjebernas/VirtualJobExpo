<?php

namespace Database\Seeders;

use App\Models\Company;
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
        Company::create([
            'name' => 'Five Nights at Freddies Inc.',
            'industry' => 'Computer',
            'address' => 'Surkland, NY',
            'contact_number' => '09278483921',
            'email' => 'fnaf@company.com',
        ]);

        User::create([
            'email' => 'fnaf@company.com',
            'role' => 'company',
            'password' => Hash::make('wangan00'),
        ]);

        // =============================================================================

        Company::create([
            'name' => 'SE Company',
            'industry' => 'Technology',
            'address' => 'Metro Manila',
            'contact_number' => '09272727728',
            'email' => 'se@company.com',
        ]);

        User::create([
            'email' => 'se@company.com',
            'role' => 'company',
            'password' => Hash::make('wangan00'),
        ]);
    }
}
