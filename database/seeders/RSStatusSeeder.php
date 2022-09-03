<?php

namespace Database\Seeders;

use App\Models\RequestService\RSStatus;
use Illuminate\Database\Seeder;

class RSStatusSeeder extends Seeder
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
                'status_name' => 'Closed'
            ],

            [
                'id' => 2,
                'status_name' => 'On Hold'
            ],
            [
                'id' => 3,
                'status_name' => 'Open'
            ],
            [
                'id' => 4,
                'status_name' => 'Resolved'
            ]

        ];

        foreach ($jobs as $job){
            $jobModel = RSStatus::create($job);
        }
    }
}
