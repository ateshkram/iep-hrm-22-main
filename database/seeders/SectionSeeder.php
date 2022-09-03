<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'section_name' => 'Faculty of Science Technology & Environment'
            ],
            [
                'section_name' => 'Faculty of Business & Economics'
            ],
            [
                'section_name' => 'Faculty of Arts, Law and Education'
            ],
            [
                'section_name' => 'The University of the South Pacific'
            ],

        ];

        foreach ($sections as $section){
            $sectionModel = \App\Models\Organisation\Section::create($section);
        }
    }
}
