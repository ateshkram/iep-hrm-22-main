<?php

namespace Database\Seeders;

use App\Models\Organisation\Section;
use App\Models\Recruitment\Checklist;
use App\Models\Recruitment\JobAdvertisement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SectionSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ChecklistSeeder::class);
        $this->call(SetupRolePermissions::class);
        $this->call(StaffSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(JobDescriptionSeeder::class);
        $this->call(LeaveStatusSeeder::class);
        $this->call(LeaveTypeSeeder::class);
        $this->call(RSClosureCodeSeeder::class);
        $this->call(RSPrioritySeeder::class);
        $this->call(EmployeeClassSeeder::class);

        $this->call(RSStatusSeeder::class);

    }
}
