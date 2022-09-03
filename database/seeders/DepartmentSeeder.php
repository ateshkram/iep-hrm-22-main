<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'department_name' => 'ITS',
                'section_id' => 4
            ],
            //FSTE
            [
                'department_name' => 'School of Computing, Information and Mathematical Sciences',
                'section_id' => 1
            ],
            [
                'department_name' => 'School of Engineering and Physics',
                'section_id' => 1
            ],
            [
                'department_name' => 'School of Geography, Earth Science and Environment',
                'section_id' => 1
            ],
            [
                'department_name' => 'School of Marine Studies',
                'section_id' => 1
            ],
            [
                'department_name' => 'School of Biological and Chemical Sciences',
                'section_id' => 1
            ],
            [
                'department_name' => 'Institute of Marine Resources (IMR)',
                'section_id' => 1
            ],
            [
                'department_name' => 'Institute of Applied Sciences (IAS)',
                'section_id' => 1
            ],

            //FBE
            [
                'department_name' => 'School of Tourism and Hospitality Management',
                'section_id' => 2
            ],
            [
                'department_name' => 'Graduate School of Business (GSB)',
                'section_id' => 2
            ],
            [
                'department_name' => 'School of Accounting and Finance (SOAF)',
                'section_id' => 2
            ],
            [
                'department_name' => 'School of Economics (SOE)',
                'section_id' => 2
            ],
            [
                'department_name' => 'School of Government, Development and International Affairs',
                'section_id' => 2
            ],
            [
                'department_name' => 'School of Management and Public Administration',
                'section_id' => 2
            ],
            [
                'department_name' => 'School of Agriculture and Food Technology',
                'section_id' => 2
            ],
            [
                'department_name' => 'Pacific Islands Centre for Public Administration',
                'section_id' => 2
            ],
            //FALE
            [
                'department_name' => 'School of Education',
                'section_id' => 3
            ],
            [
                'department_name' => 'School of Law',
                'section_id' => 3
            ],
            [
                'department_name' => 'School of Language, Arts and Media',
                'section_id' => 3
            ],
            [
                'department_name' => 'School of Social Sciences',
                'section_id' => 3
            ],
            [
                'department_name' => 'Institute of Education (IOE)',
                'section_id' => 3
            ],
            [
                'department_name' => 'Educare',
                'section_id' => 3
            ],
            [
                'department_name' => 'Oceania Centre for Arts, Culture and Pacific Studies',
                'section_id' => 3
            ],
        ];

        foreach ($departments as $department){
            $departmentModel = \App\Models\Organisation\Department::create($department);
        }
    }
}
