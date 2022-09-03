<?php

namespace Database\Seeders;

use App\Models\Organisation\ACL;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SetupRolePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (ACL::roles() as $role) {
            Role::findOrCreate($role);
        }

        $adminRole = Role::findByName(ACL::ROLE_ADMIN);
        $hrAdminRole = Role::findByName(ACL::ROLE_HR_ADMIN);
        $hrRole = Role::findByName(ACL::ROLE_HR);
        $hrRecruitsRole = Role::findByName(ACL::ROLE_HR_RECRUITS);
        $supervisorRole = Role::findByName(ACL::ROLE_SUPERVISOR);
        $staffRole = Role::findByName(ACL::ROLE_STAFF);

        foreach (ACL::permissions() as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // Setup basic permission
        $adminRole->givePermissionTo(ACL::permissions());
        $hrAdminRole->givePermissionTo(ACL::permissions(
            [
                ACL::PERMISSION_VIEW_MENU_JOB_DESCRIPTIONS,

                // ACL::PERMISSION_VIEW_MENU_LEAVE_CONFIG,
                // ACL::PERMISSION_VIEW_MENU_LEAVE_REPORTS,

                ACL::PERMISSION_VIEW_MENU_REQUEST_CONFIG,
                ACL::PERMISSION_VIEW_MENU_ASSIGNED_REQUESTS,
                ACL::PERMISSION_VIEW_MENU_EMPLOYEE_REQUESTS,

            ]
        ));
        $hrRole->givePermissionTo(ACL::permissions([
            ACL::PERMISSION_VIEW_MENU_USER_MANAGEMENT,
            ACL::PERMISSION_VIEW_MENU_PERMISSION_MANAGEMENT,
            ACL::PERMISSION_VIEW_MENU_ROLE_MANAGEMENT,

            ACL::PERMISSION_VIEW_MENU_JOB_APPLICATIONS,
            ACL::PERMISSION_VIEW_MENU_JOB_DESCRIPTIONS,
            ACL::PERMISSION_VIEW_MENU_JOB_ADVERTISEMENTS,

            ACL::PERMISSION_VIEW_MENU_ASSIGNED_REQUESTS,
            ACL::PERMISSION_VIEW_MENU_EMPLOYEE_REQUESTS,

        ]));
        $hrRecruitsRole->givePermissionTo(ACL::permissions([
            ACL::PERMISSION_VIEW_MENU_USER_MANAGEMENT,
            ACL::PERMISSION_VIEW_MENU_PERMISSION_MANAGEMENT,
            ACL::PERMISSION_VIEW_MENU_ROLE_MANAGEMENT,

            ACL::PERMISSION_VIEW_MENU_LEAVE_CONFIG,
            ACL::PERMISSION_VIEW_MENU_LEAVE_REPORTS,

            ACL::PERMISSION_VIEW_MENU_REQUEST_CONFIG,
            ACL::PERMISSION_VIEW_MENU_ASSIGNED_REQUESTS,
            ACL::PERMISSION_VIEW_MENU_EMPLOYEE_REQUESTS
        ]));
        $supervisorRole->givePermissionTo(ACL::permissions([
            ACL::PERMISSION_VIEW_MENU_USER_MANAGEMENT,
            ACL::PERMISSION_VIEW_MENU_PERMISSION_MANAGEMENT,
            ACL::PERMISSION_VIEW_MENU_ROLE_MANAGEMENT,

            ACL::PERMISSION_VIEW_MENU_JOB_DESCRIPTIONS,
            ACL::PERMISSION_VIEW_MENU_JOB_APPLICATIONS,
            ACL::PERMISSION_VIEW_MENU_JOB_ADVERTISEMENTS,
            ACL::PERMISSION_VIEW_MENU_MY_JOB_ADVERTISEMENTS,

            ACL::PERMISSION_VIEW_MENU_LEAVE_CONFIG,
            ACL::PERMISSION_VIEW_MENU_LEAVE_REPORTS,

            ACL::PERMISSION_VIEW_MENU_REQUEST_CONFIG,
            ACL::PERMISSION_VIEW_MENU_ASSIGNED_REQUESTS,
            ACL::PERMISSION_VIEW_MENU_EMPLOYEE_REQUESTS
        ]));
        $staffRole->givePermissionTo(ACL::permissions([
            ACL::PERMISSION_VIEW_MENU_USER_MANAGEMENT,
            ACL::PERMISSION_VIEW_MENU_PERMISSION_MANAGEMENT,
            ACL::PERMISSION_VIEW_MENU_ROLE_MANAGEMENT,

            ACL::PERMISSION_VIEW_MENU_JOB_DESCRIPTIONS,
            ACL::PERMISSION_VIEW_MENU_JOB_ADVERTISEMENTS,
            ACL::PERMISSION_VIEW_MENU_MY_JOB_ADVERTISEMENTS,
            ACL::PERMISSION_VIEW_MENU_JOB_APPLICATIONS,

            ACL::PERMISSION_VIEW_MENU_LEAVE_CONFIG,
            ACL::PERMISSION_VIEW_MENU_LEAVE_REPORTS,
            ACL::PERMISSION_VIEW_MENU_LEAVE_LIST,

            ACL::PERMISSION_VIEW_MENU_ASSIGNED_REQUESTS,
            ACL::PERMISSION_VIEW_MENU_EMPLOYEE_REQUESTS,
            ACL::PERMISSION_VIEW_MENU_REQUEST_CONFIG,
        ]));
    }
}
