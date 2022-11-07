<?php

namespace Database\Seeders;

use App\Models\JobPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobPost::create([
            'position' => 'Software Engineer',
            'company' => 'SE Company',
            'location' => 'Metro Manila',
            'level' => 'Entry level',
            'employment' => 'Full-time',
            'salary_range' => array('low' => '15000', 'high' => '20000'),
            'company_id' => '1',
        ]);

        JobPost::create([
            'position' => 'Web Developer',
            'company' => 'Five Nights at Freddies Inc.',
            'location' => 'Surkland, NY',
            'level' => 'Intermediate',
            'employment' => 'Full-time',
            'salary_range' => array('low' => '25000', 'high' => '45000'),
            'company_id' => '2',
        ]);

        JobPost::create([
            'position' => 'IT Consultant',
            'company' => 'Five Nights at Freddies Inc.',
            'location' => 'Surkland, NY',
            'level' => 'Entry level',
            'employment' => 'Full-time',
            'salary_range' => array('low' => '18000', 'high' => '22000'),
            'company_id' => '2',
        ]);

        JobPost::create([
            'position' => 'QA Specialist',
            'company' => 'SE Company',
            'location' => 'Metro Manila',
            'level' => 'Entry level',
            'employment' => 'Full-time',
            'salary_range' => array('low' => '20000', 'high' => '25000'),
            'company_id' => '1',
        ]);

        JobPost::create([
            'position' => 'Game Developer',
            'company' => 'Five Nights at Freddies Inc.',
            'location' => 'Surkland, NY',
            'level' => 'Senior',
            'employment' => 'Full-time',
            'salary_range' => array('low' => '80000', 'high' => '120000'),
            'company_id' => '2',
        ]);

        JobPost::create([
            'position' => 'DevOps',
            'company' => 'SE Company',
            'location' => 'Metro Manila',
            'level' => 'Senior level',
            'employment' => 'Full-time',
            'salary_range' => array('low' => '80000', 'high' => '100000'),
            'company_id' => '1',
        ]);

        JobPost::create([
            'position' => 'Software Analyst',
            'company' => 'SE Company',
            'location' => 'Metro Manila',
            'level' => 'Intermediate',
            'employment' => 'Full-time',
            'salary_range' => array('low' => '50000', 'high' => '70000'),
            'company_id' => '1',
        ]);

        JobPost::create([
            'position' => 'Project Manager',
            'company' => 'Five Nights at Freddies Inc.',
            'location' => 'Surkland, NY',
            'level' => 'Senior',
            'employment' => 'Full-time',
            'salary_range' => array('low' => '100000', 'high' => '130000'),
            'company_id' => '2',
        ]);
    }
}
