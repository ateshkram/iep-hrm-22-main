<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LeaveStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leave_statuses = [


            [
                'status_name' => 'Pending',
                'status_description' => 'xyz'
            ],
            [
                'status_name' => 'Approved',
                'status_description' => 'xyz'
            ],
            [
                'status_name' => 'Cancelled',
                'status_description' => 'xyz'
            ],
            [
                'status_name' => 'disapproved',
                'status_description' => 'xyz'
            ],
            [
                'status_name' => 'taken',
                'status_description' => 'xyz'
            ]
        ];

        foreach ($leave_statuses as $leave_status){
            \App\Models\Leave\LeaveStatus::create($leave_status);
        }
    }
}
