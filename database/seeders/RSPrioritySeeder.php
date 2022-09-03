<?php

namespace Database\Seeders;

use App\Models\RequestService\RSPriority;
use Illuminate\Database\Seeder;

class RSPrioritySeeder extends Seeder
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
                'priority_name' => 'High'
            ],

            [
                'id' => 2,
                'priority_name' => 'Low'
            ],
            [
                'id' => 3,
                'priority_name' => 'Medium'
            ],
            [
                'id' => 4,
                'priority_name' => 'Normal'
            ]

        ];

        foreach ($jobs as $job){
            $jobModel = RSPriority::create($job);
        }
    }
}
