<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'course_management_access',],
            ['id' => 18, 'title' => 'trail_management_access',],
            ['id' => 19, 'title' => 'setting_access',],
            ['id' => 20, 'title' => 'coursescategory_access',],
            ['id' => 21, 'title' => 'coursescategory_create',],
            ['id' => 22, 'title' => 'coursescategory_edit',],
            ['id' => 23, 'title' => 'coursescategory_view',],
            ['id' => 24, 'title' => 'coursescategory_delete',],
            ['id' => 25, 'title' => 'trailscategory_access',],
            ['id' => 26, 'title' => 'trailscategory_create',],
            ['id' => 27, 'title' => 'trailscategory_edit',],
            ['id' => 28, 'title' => 'trailscategory_view',],
            ['id' => 29, 'title' => 'trailscategory_delete',],
            ['id' => 30, 'title' => 'lesson_access',],
            ['id' => 31, 'title' => 'lesson_create',],
            ['id' => 32, 'title' => 'lesson_edit',],
            ['id' => 33, 'title' => 'lesson_view',],
            ['id' => 34, 'title' => 'lesson_delete',],
            ['id' => 35, 'title' => 'course_access',],
            ['id' => 36, 'title' => 'course_create',],
            ['id' => 37, 'title' => 'course_edit',],
            ['id' => 38, 'title' => 'course_view',],
            ['id' => 39, 'title' => 'course_delete',],
            ['id' => 40, 'title' => 'trail_access',],
            ['id' => 41, 'title' => 'trail_create',],
            ['id' => 42, 'title' => 'trail_edit',],
            ['id' => 43, 'title' => 'trail_view',],
            ['id' => 44, 'title' => 'trail_delete',],
            ['id' => 45, 'title' => 'datacourse_access',],
            ['id' => 46, 'title' => 'datacourse_create',],
            ['id' => 47, 'title' => 'datacourse_edit',],
            ['id' => 48, 'title' => 'datacourse_view',],
            ['id' => 49, 'title' => 'datacourse_delete',],
            ['id' => 50, 'title' => 'datatrail_access',],
            ['id' => 51, 'title' => 'datatrail_create',],
            ['id' => 52, 'title' => 'datatrail_edit',],
            ['id' => 53, 'title' => 'datatrail_view',],
            ['id' => 54, 'title' => 'datatrail_delete',],
            ['id' => 55, 'title' => 'user_action_access',],
            ['id' => 56, 'title' => 'user_action_create',],
            ['id' => 57, 'title' => 'user_action_edit',],
            ['id' => 58, 'title' => 'user_action_view',],
            ['id' => 59, 'title' => 'user_action_delete',],
            ['id' => 60, 'title' => 'team_access',],
            ['id' => 61, 'title' => 'team_create',],
            ['id' => 62, 'title' => 'team_edit',],
            ['id' => 63, 'title' => 'team_view',],
            ['id' => 64, 'title' => 'team_delete',],
            ['id' => 65, 'title' => 'internal_notification_access',],
            ['id' => 66, 'title' => 'internal_notification_create',],
            ['id' => 67, 'title' => 'internal_notification_edit',],
            ['id' => 68, 'title' => 'internal_notification_view',],
            ['id' => 69, 'title' => 'internal_notification_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
