<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $checklists = [
            [
                'checklist_name' => 'CV',

            ],
            [
                'checklist_name' => 'Expression of Interest/Cover Letter',

            ],
            [
                'checklist_name' => 'Academic Transcript',

            ],
            [
                'checklist_name' => 'Referee',

            ],
        ];

        foreach ($checklists as $checklist){
            $checklistModel = \App\Models\Recruitment\Checklist::create($checklist);
        }
    }
}
