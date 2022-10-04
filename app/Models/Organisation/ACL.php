<?php


namespace App\Models\Organisation;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class ACL
{
    const ROLE_ADMIN = 'Admin';
    const ROLE_HR_ADMIN = 'HR Admin';
    const ROLE_HR = 'HR';
    const ROLE_HR_RECRUITS = 'HR Recruits';
    const ROLE_SUPERVISOR = 'Supervisor';
    const ROLE_STAFF = 'Staff';

    //Recruitment
    const PERMISSION_VIEW_MENU_JOB_DESCRIPTIONS = 'view menu job descriptions';
    const PERMISSION_VIEW_MENU_JOB_ADVERTISEMENTS = 'view menu job advertisements';
    const PERMISSION_VIEW_MENU_JOB_APPLICATIONS = 'view menu job applications';
    const PERMISSION_VIEW_MENU_MY_JOB_ADVERTISEMENTS = 'view menu my job advertisements';

    //User Management
    const PERMISSION_VIEW_MENU_PERMISSION_MANAGEMENT = 'view menu permission management';
    const PERMISSION_VIEW_MENU_ROLE_MANAGEMENT = 'view menu role management';
    const PERMISSION_VIEW_MENU_USER_MANAGEMENT = 'view menu user management';

    //LEAVE
    const PERMISSION_VIEW_MENU_LEAVE_CONFIG = 'view menu leave config';
    const PERMISSION_VIEW_MENU_LEAVE_REPORTS = 'view menu leave report';
    const PERMISSION_VIEW_MENU_LEAVE_LIST = 'view menu leave list';
    const PERMISSION_VIEW_MENU_LEAVE = 'view menu leave';
    const PERMISSION_VIEW_MENU_LEAVE_HISTORY= 'view annual leave history';

    //REQUEST
    const PERMISSION_VIEW_MENU_REQUEST_SERVICE_DESK = 'view menu request service desk';
    const PERMISSION_VIEW_MENU_ASSIGNED_REQUESTS = 'view menu assigned requests';
    const PERMISSION_VIEW_MENU_EMPLOYEE_REQUESTS = 'view menu employee requests';
    const PERMISSION_VIEW_MENU_REQUEST_CONFIG = 'view menu request config';

    //DISCIPLINARY
    const PERMISSION_VIEW_MENU_DISCIPLINARY_CONFIG = 'view menu disciplinary config';
    const PERMISSION_VIEW_MENU_DISCIPLINARY_COMMITTEE = 'view menu disciplinary committee';
    const PERMISSION_VIEW_MENU_DISCIPLINARY_CASE_DASHBOARD = 'view menu disciplinary case dashboard';
    const PERMISSION_VIEW_MENU_DISCIPLINARY_CASE_DESK = 'view menu disciplinary case desk';
    const PERMISSION_VIEW_MENU_DISCIPLINARY_CASE_MY = 'view menu my disciplinary cases';

    /**
     * @param array $exclusives Exclude some permissions from the list
     * @return array
     */
    public static function permissions(array $exclusives = []): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function($value, $key) use ($exclusives) {
                return !in_array($value, $exclusives) && Str::startsWith($key, 'PERMISSION_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function menuPermissions(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function($value, $key) {
                return Str::startsWith($key, 'PERMISSION_VIEW_MENU_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    /**
     * @return array
     */
    public static function roles(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $roles =  Arr::where($constants, function($value, $key) {
                return Str::startsWith($key, 'ROLE_');
            });

            return array_values($roles);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }
}
