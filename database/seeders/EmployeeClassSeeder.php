<?php

namespace Database\Seeders;

use App\Models\Organisation\EmployeeClass;
use Illuminate\Database\Seeder;

class EmployeeClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [


            [
                'id' => 1,
                'employee_class_name' => 'Academic Staff'
            ],

            [
                'id' => 2,
                'employee_class_name' => 'Comparable Staff'
            ],
            [
                'id' => 3,
                'employee_class_name' => 'Intermediate Staff'
            ],
            [
                'id' => 4,
                'employee_class_name' => 'Junior Staff'
            ],
            [
                'id' => 5,
                'employee_class_name' => 'Permanent Hourly Staff'
            ],
            [
                'id' => 6,
                'employee_class_name' => 'Vice Chancellor and president'
            ],
            [
                'id' => 7,
                'employee_class_name' => 'Senior Management Staff'
            ]

        ];

        foreach ($jobs as $job){
            $jobModel = EmployeeClass::create($job);
        }
    }
}
