<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leave_types = [


            [
                'leave_type_name' => 'sick',
                'leave_type_description' => 'sick leave ',


            ],
            [
                'leave_type_name' => 'casual',
                'leave_type_description' => 'casual leave ',


            ],
            [
                'leave_type_name' => 'vacation',
                'leave_type_description' => 'vacation leave ',


            ],
        ];

        foreach ($leave_types as $leave_type){
            \App\Models\Leave\LeaveType::create($leave_type);
        }
    }
}
