<?php

namespace Database\Seeders;

use App\Models\RequestService\RSClosureCode;
use Illuminate\Database\Seeder;

class RSClosureCodeSeeder extends Seeder
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
                'code_name' => 'Cancelled'
            ],

            [
                'id' => 2,
                'code_name' => 'Failed'
            ],
            [
                'id' => 3,
                'code_name' => 'Postponed'
            ],
            [
                'id' => 4,
                'code_name' => 'Success'
            ]

        ];

        foreach ($jobs as $job){
            $jobModel = RSClosureCode::create($job);
        }
    }
}
