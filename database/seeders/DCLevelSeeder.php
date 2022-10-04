<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\DisciplinaryCase\DCLevel;

class DCLevelSeeder extends Seeder
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
                'level_name' => 'warning',
                'level_max' => 3,
                'level_min' => 0,
                'level_successor_id' => 2
            ],

            [
                'id' => 2,
                'level_name' => 'suspension',
                'level_max' => 2,
                'level_min' => 0,
                'level_predecessor_id' => 1,
                'level_successor_id' => 3
            ],
            [
                'id' => 3,
                'level_name' => 'termination',
                'level_max' => 1,
                'level_min' => 0,
                'level_predecessor_id' => 2
            ],
       
        ];

        foreach ($jobs as $job){
            $jobModel = DCLevel::create($job);
        }
    }

}

