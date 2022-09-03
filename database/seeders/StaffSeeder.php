<?php

namespace Database\Seeders;

use App\Models\Organisation\ACL;
use App\Models\Users\Staff;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Staff::factory()->create(
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'name' => 'Admin User'
            ]
        );

        $hr_admin = Staff::factory()->create(
            [
                'email' => 'hradmin@gmail.com',
            ]
        );

        $hr_recruits = Staff::factory()->create(
            [
                'email' => 'hrrecruits@gmail.com',
            ]
        );
        $hr = Staff::factory()->create(
            [
                'email' => 'hr@gmail.com',
            ]
        );
        $supervisor = Staff::factory()->create(
            [
                'email' => 'supervisor@gmail.com',
            ]
        );
        $staff = Staff::factory()->create(
            [
                'email' => 'staff@gmail.com',
            ]
        );

        $admin->syncRoles(Role::findByName(ACL::ROLE_ADMIN));
        $hr_admin->syncRoles(Role::findByName(ACL::ROLE_HR_ADMIN));
        $hr_recruits->syncRoles(Role::findByName(ACL::ROLE_HR_RECRUITS));
        $hr->syncRoles(Role::findByName(ACL::ROLE_HR));
        $supervisor->syncRoles(Role::findByName(ACL::ROLE_SUPERVISOR));
        $staff->syncRoles(Role::findByName(ACL::ROLE_STAFF));
    }
}
