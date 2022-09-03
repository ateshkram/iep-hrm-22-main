<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            [
                'skill_name' => 'Good Communication Skills',
            ],
            [
                'skill_name' => 'Analytical Skills',
            ],
            [
                'skill_name' => 'Critical Thinking',
            ],
            [
                'skill_name' => 'Marketing Skills',
            ],
            [
                'skill_name' => 'Financial Skills',
            ],
            [
                'skill_name' => 'MYOB',
            ],
            [
                'skill_name' => 'Office Skills',
            ],
            [
                'skill_name' => 'Project Management Skills',
            ],
            [
                'skill_name' => 'php',
            ],
            [
                'skill_name' => 'Web Development',
            ],
            [
                'skill_name' => 'JavaScript',
            ],
            [
                'skill_name' => 'Flutter',
            ],
            [
                'skill_name' => 'HTML & CSS',
            ],
            [
                'skill_name' => 'API Development',
            ],
            [
                'skill_name' => 'ASP.NET',
            ],
            [
                'skill_name' => 'AI Machine Learning',
            ],
            [
                'skill_name' => 'Java',
            ],
            [
                'skill_name' => 'C++',
            ],
            [
                'skill_name' => 'Networks & Security',
            ],
            [
                'skill_name' => 'Marketing',
            ],
            [
                'skill_name' => 'Leadership',
            ],
            [
                'skill_name' => 'Good Team Player',
            ],
            [
                'skill_name' => 'API Development',
            ],
            [
                'skill_name' => 'Java Spring Boot',
            ],
            [
                'skill_name' => 'VueJS',
            ],
            [
                'skill_name' => 'Laravel',
            ],
            [
                'skill_name' => 'Mobile App Development',
            ],

        ];

        foreach ($skills as $skill){
            $skillModel = \App\Models\Recruitment\Skill::create($skill);
        }
    }
}
