<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [App\Http\Controllers\AppController::class, 'index'])->name('home');
Route::get('/staff-directory', [App\Http\Controllers\AppController::class, 'staff_directory'])->name('staff-directory');
Route::get('/profile', [App\Http\Controllers\Staff\StaffController::class, 'index'])->name('profile');


Route::prefix('admin')
    ->middleware('auth')
    ->group( function (){
        Route::get('/user-management', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user-management');
        Route::get('/role-management', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role-management');
        Route::get('/permission-management', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permission-management');

        Route::post('/permissions-management/store',[App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('store-permission');
        Route::put('/permission-management/{id}/update',[App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('update-permission');
        Route::delete('/permission-management/{id}/delete',[App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('delete-permission');

        Route::post('/role-management/store',[App\Http\Controllers\Admin\RoleController::class, 'store'])->name('store-role');
        Route::put('/role-management/{id}/update',[App\Http\Controllers\Admin\RoleController::class, 'update'])->name('update-role');
        Route::delete('/role-management/{id}/delete',[App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('delete-role');

        Route::post('/user-management/store',[App\Http\Controllers\Admin\UserController::class, 'store'])->name('store-hrms-user');
        Route::put('/user-management/{id}/assign-new-role',[App\Http\Controllers\Admin\UserController::class, 'assign_new_role'])->name('assign-new-role');
        Route::put('/user-management/{id}/assign-extra-permissions',[App\Http\Controllers\Admin\UserController::class, 'assign_extra_permissions'])->name('assign-extra-permissions');
        Route::delete('/user-management/{id}/delete',[App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('delete-hrms-user');

        Route::post('/user-management/store-portal-user',[App\Http\Controllers\Admin\UserController::class, 'store_portal_user'])->name('store-portal-user');
        Route::put('/user-management/{id}/update-portal-user',[App\Http\Controllers\Admin\UserController::class, 'update_portal_user'])->name('update-portal-user');
        Route::delete('/user-management/{id}/delete-portal-user',[App\Http\Controllers\Admin\UserController::class, 'destroy_portal_user'])->name('delete-portal-user');
    });

Route::prefix('recruitment')
    ->middleware('auth')
    ->group(function (){
        Route::get('/job-descriptions', [App\Http\Controllers\Recruitment\JobDescriptionController::class, 'index'])->name('all-job-descriptions');
        Route::get('/job-descriptions/{id}/show', [App\Http\Controllers\Recruitment\JobDescriptionController::class, 'show'])->name('show-job-description');
        Route::get('/job-descriptions/{id}/edit', [App\Http\Controllers\Recruitment\JobDescriptionController::class, 'edit'])->name('edit-job-description');
        Route::get('/job-descriptions/create', [App\Http\Controllers\Recruitment\JobDescriptionController::class, 'create'])->name('create-job-description');
        Route::post('/job-descriptions/store', [App\Http\Controllers\Recruitment\JobDescriptionController::class, 'store'])->name('store-job-description');
        Route::put('/job-descriptions/{id}/update', [App\Http\Controllers\Recruitment\JobDescriptionController::class, 'update'])->name('update-job-description');
        Route::delete('/job-descriptions/{id}/delete', [App\Http\Controllers\Recruitment\JobDescriptionController::class, 'destroy'])->name('delete-job-description');

        //AJAX Routes
        Route::post('/ajax/job-descriptions', [App\Http\Controllers\Recruitment\JobDescriptionController::class, 'get_job_descriptions'])->name('ajax-get-job-description');
        Route::post('/recruitment/get-department', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'geDepartment'])->name('ajax-department');

        Route::get('/job-advertisements', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'index'])->name('all-job-advertisements');
        Route::get('/my-job-advertisements', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'my_job_advertisements'])->name('my-job-advertisements');
        Route::get('/job-advertisements/create', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'create'])->name('create-job-advertisement');
        Route::post('/job-advertisements/store', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'store'])->name('store-job-advertisement');
        Route::get('/job-advertisements/{id}/show', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'show'])->name('show-job-advertisement');
        Route::get('/job-advertisements/{id}/edit', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'edit'])->name('edit-job-advertisement');
        Route::put('/job-advertisements/{id}/update', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'update'])->name('update-job-advertisement');
        Route::put('/job-advertisements/{id}/publish', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'publish'])->name('publish-job-advertisement');
        Route::put('/job-advertisements/{id}/unpublish', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'unpublish'])->name('unpublish-job-advertisement');

        Route::get('/job-applications', [App\Http\Controllers\Recruitment\JobApplicationController::class, 'index'])->name('all-job-applications');
        Route::get('/job-applications/{id}/show', [App\Http\Controllers\Recruitment\JobApplicationController::class, 'show'])->name('show-job-application');
        Route::get('/job-applications/{id}/review', [App\Http\Controllers\Recruitment\JobApplicationController::class, 'edit'])->name('edit-job-application');
        Route::put('/job-applications/{id}/review', [App\Http\Controllers\Recruitment\JobApplicationController::class, 'update'])->name('review-job-application');
    });

//Route::prefix('leave')
//    ->middleware('auth')
//    ->group(function (){
//
//        // Leave Routes
//        Route::get('/', [App\Http\Controllers\Leave\LeaveController::class, 'index'])->name('leave');
//        Route::post('/type_create', [App\Http\Controllers\Leave\LeaveController::class, 'leave_type_create'])->name('leave_type_create');
//        Route::patch('/type_update/{id}', [App\Http\Controllers\Leave\LeaveController::class, 'leave_type_update'])->name('leave_type_update');
//        Route::get('/list', [App\Http\Controllers\Leave\LeaveController::class, 'leave_list'])->name('leave_list');
//        Route::get('/entitlements', [App\Http\Controllers\Leave\LeaveController::class, 'entitlements'])->name('entitlements');
//        Route::get('/report', [App\Http\Controllers\Leave\LeaveController::class, 'report'])->name('report');
//        Route::get('/apply', [App\Http\Controllers\Leave\LeaveController::class, 'leave_apply'])->name('leave_apply');
//        Route::post('/application/create', [App\Http\Controllers\Leave\LeaveController::class, 'leave_application_create'])->name('application_create');
//        Route::post('/entitlement/create', [App\Http\Controllers\Leave\LeaveController::class, 'entitlement_create'])->name('entitlement_create');
//        Route::post('/employee_count', [App\Http\Controllers\Leave\LeaveController::class, 'count_employee'])->name('employee_count');
//        Route::post('/entitlement_count', [App\Http\Controllers\Leave\LeaveController::class, 'entitlement_count'])->name('entitlement_count');
//        Route::post('/leave_status_update/{id}', [App\Http\Controllers\Leave\LeaveController::class, 'leave_status_update'])->name('leave_status_update');
//        Route::post('/days_count', [App\Http\Controllers\Leave\LeaveController::class, 'days_count'])->name('days_count');
//        Route::get('/history', [App\Http\Controllers\Leave\LeaveController::class, 'leave_history'])->name('leave_history');
//        Route::get('/export', [App\Http\Controllers\Leave\LeaveController::class, 'export'])->name('export');
//
//    });

//Route::prefix('help-desk')
//    ->middleware('auth')
//    ->group(function (){
//        Route::get('/request', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'request'])->name('request');
//        Route::post('/request/create', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'request_create'])->name('request_create');
//        Route::get('/request/technicians', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'Technicians_request'])->name('Technicians_request');
//        Route::post('/request/category_update', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'request_types_update'])->name('request_cat_update');
//
//        Route::get('/', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'request_config'])->name('request_config');
//        Route::get('/request/list', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'Employee_request'])->name('Employee_request');
//        Route::post('/request/type_create', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'request_type_create'])->name('request_type_create');
//        Route::post('/request/type_update/{id}', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'request_type_update'])->name('request_type_update');
//
//
//        Route::post('/request/status_update', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'request_status_update'])->name('request_status_update');
//        Route::post('/request/close/{id}', [App\Http\Controllers\RequestServiceDesk\RequestDeskController::class, 'close_request'])->name('close_request');
//
//    });

Auth::routes();

Route::prefix('hrms')
    ->as('hrms.')
    ->middleware('auth')
    ->group(function (){
        
        //Leave Routes
        Route::get('/leave', [App\Http\Controllers\Leave\LeaveController::class, 'index'])->name('leave');
        Route::post('/leave/type_create', [App\Http\Controllers\Leave\LeaveController::class, 'leave_type_create'])->name('leave_type_create');
        Route::patch('/leave/type_update/{id}', [App\Http\Controllers\Leave\LeaveController::class, 'leave_type_update'])->name('leave_type_update');
        Route::get('/leave/list', [App\Http\Controllers\Leave\LeaveController::class, 'leave_list'])->name('leave_list');
        Route::get('/leave/entitlements', [App\Http\Controllers\Leave\LeaveController::class, 'entitlements'])->name('entitlements');
        Route::get('/leave/report', [App\Http\Controllers\Leave\LeaveController::class, 'report'])->name('report');
        Route::get('/leave/apply', [App\Http\Controllers\Leave\LeaveController::class, 'leave_apply'])->name('leave_apply');
        Route::post('/leave/application/create', [App\Http\Controllers\Leave\LeaveController::class, 'leave_application_create'])->name('application_create');
        Route::post('/leave/entitlement/create', [App\Http\Controllers\Leave\LeaveController::class, 'entitlement_create'])->name('entitlement_create');
        Route::post('/leave/employee_count', [App\Http\Controllers\Leave\LeaveController::class, 'count_employee'])->name('employee_count');
        Route::post('/leave/entitlement_count', [App\Http\Controllers\Leave\LeaveController::class, 'entitlement_count'])->name('entitlement_count');
        Route::post('/leave/days_count', [App\Http\Controllers\Leave\LeaveController::class, 'days_count'])->name('days_count');
        Route::post('/leave/leave_status_update/{id}', [App\Http\Controllers\Leave\LeaveController::class, 'leave_status_update'])->name('leave_status_update');
        Route::post('/leave/delete_leave_type/{id}', [App\Http\Controllers\Leave\LeaveController::class, 'delete_leave_type'])->name('delete_leave_type');
        Route::post('/leave/leave_application_cancel/{id}', [App\Http\Controllers\Leave\LeaveController::class, 'leave_application_cancel'])->name('leave_application_cancel');
        Route::get('/leave/history', [App\Http\Controllers\Leave\LeaveController::class, 'leave_history'])->name('leave_history');

        //Request Desk Routes
        Route::get('/RequestService', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request_config'])->name('request_config');
        Route::get('/RequestService/list', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'Employee_request'])->name('Employee_request');
        Route::post('/RequestService/type_create', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request_type_create'])->name('request_type_create');
        Route::post('/RequestService/type_update/{id}', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request_type_update'])->name('request_type_update');
        Route::post('/RequestService/types_update', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request_types_update'])->name('request_types_update');
        Route::post('/RequestService/types_delete/{id}', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request_type_delete'])->name('request_type_delete');

        Route::post('/RequestService/status_update', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request_status_update'])->name('request_status_update');
        Route::post('/RequestService/close/{id}', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'close_request'])->name('close_request');

        //Request Routes
        Route::get('/request', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request'])->name('request');
        Route::post('/request/create', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request_create'])->name('request_create');
        Route::post('/request/update/{id}', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request_update'])->name('request_update');
        Route::get('/RequestService/list', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'Employee_request'])->name('Employee_request');
        Route::get('/RequestService/technicians', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'Technicians_request'])->name('Technicians_request');
        Route::post('/RequestService/request/cancel/{id}', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'request_cancel'])->name('request_cancel');

      
        Route::get('/email', [App\Http\Controllers\RequestDesk\RequestDeskController::class, 'sendmail'])->name('sendmail');
//        Route::get('/export', [App\Http\Controllers\HRMS\Leave\LeaveController::class, 'export'])->name('export');
//        Route::get('/download', [App\Http\Controllers\HRMS\Leave\LeaveController::class, 'download'])->name('download');

//        Route::get('/recruitment/create_job', [App\Http\Controllers\PageController::class, 'create_job'])->name('create_job');
//        Route::get('/recruitment/jobs', [App\Http\Controllers\Recruitment\JobController::class, 'index'])->name('jobs');
//        Route::get('/recruitment/jobs/view/{job}', [App\Http\Controllers\Recruitment\JobController::class, 'show'])->name('job-details');
//        Route::get('/recruitment/jobs/edit/{job}', [App\Http\Controllers\Recruitment\JobController::class, 'edit'])->name('update-job-details');
//        Route::get('/recruitment/vacancies', [App\Http\Controllers\Recruitment\JobAdvertisementController::class, 'index'])->name('vacancies');
//        Route::get('/registration',[App\Http\Controllers\RegistrationController::class,'index'])->name('registration');
//        Route::post('/registration/create',[App\Http\Controllers\RegistrationController::class,'store'])->name('store_registration');

        //Disciplinary Routes
        Route::get('/DisciplinaryCaseConfig', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_config'])->name('disciplinary_config');
        Route::post('/DisciplinaryCaseConfig/type_create', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_type_create'])->name('disciplinary_type_create');
        Route::post('/DisciplinaryCaseConfig/type_update/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_type_update'])->name('disciplinary_type_update');
        Route::post('/DisciplinaryCaseConfig/type_delete/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_type_delete'])->name('disciplinary_type_delete');

        Route::get('/DisciplinaryCaseCommittee', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_committee'])->name('disciplinary_committee');
        Route::post('/DisciplinaryCaseCommittee/committee_create', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_committee_create'])->name('disciplinary_committee_create');
        Route::post('/DisciplinaryCaseCommittee/committee_update/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_committee_update'])->name('disciplinary_committee_update');
        Route::post('/DisciplinaryCaseCommittee/committee_delete/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_committee_delete'])->name('disciplinary_committee_delete');

        Route::get('/DisciplinaryCaseDash', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_case'])->name('disciplinary_case');
        Route::post('/DisciplinaryCaseDash/case_create', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_case_create'])->name('disciplinary_case_create');
        Route::post('/DisciplinaryCaseDash/case_update/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_case_update'])->name('disciplinary_case_update');
        Route::post('/DisciplinaryCaseDash/case_cancel/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_case_cancel'])->name('disciplinary_case_cancel');

        Route::get('/DisciplinaryCaseDesk', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_desk'])->name('disciplinary_desk');
        Route::post('/DisciplinaryCaseDesk/case_warning/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_desk_warning'])->name('disciplinary_desk_warning');
        Route::post('/DisciplinaryCaseDesk/case_suspend/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_desk_suspend'])->name('disciplinary_desk_suspend');
        Route::post('/DisciplinaryCaseDesk/case_terminate/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_desk_terminate'])->name('disciplinary_desk_terminate');
        Route::post('/DisciplinaryCaseDesk/case_status_update', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'case_status_update'])->name('case_status_update');
        Route::post('/DisciplinaryCaseDesk/case_close/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'case_close'])->name('case_close');

        Route::get('/DisciplinaryCaseDetails/{id}', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'disciplinary_details'])->name('disciplinary_details');
        Route::get('/DisciplinaryCaseMy', [App\Http\Controllers\DisciplinaryTracker\DisciplinaryCaseController::class, 'my_disciplinary_case'])->name('my_disciplinary_case');

    });
