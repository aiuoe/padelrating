<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'club_create',
            ],
            [
                'id'    => 18,
                'title' => 'club_edit',
            ],
            [
                'id'    => 19,
                'title' => 'club_show',
            ],
            [
                'id'    => 20,
                'title' => 'club_delete',
            ],
            [
                'id'    => 21,
                'title' => 'club_access',
            ],
            [
                'id'    => 22,
                'title' => 'tournament_create',
            ],
            [
                'id'    => 23,
                'title' => 'tournament_edit',
            ],
            [
                'id'    => 24,
                'title' => 'tournament_show',
            ],
            [
                'id'    => 25,
                'title' => 'tournament_delete',
            ],
            [
                'id'    => 26,
                'title' => 'tournament_access',
            ],
            [
                'id'    => 27,
                'title' => 'player_create',
            ],
            [
                'id'    => 28,
                'title' => 'player_edit',
            ],
            [
                'id'    => 29,
                'title' => 'player_show',
            ],
            [
                'id'    => 30,
                'title' => 'player_delete',
            ],
            [
                'id'    => 31,
                'title' => 'player_access',
            ],
            [
                'id'    => 32,
                'title' => 'score_create',
            ],
            [
                'id'    => 33,
                'title' => 'score_edit',
            ],
            [
                'id'    => 34,
                'title' => 'score_show',
            ],
            [
                'id'    => 35,
                'title' => 'score_delete',
            ],
            [
                'id'    => 36,
                'title' => 'score_access',
            ],
            [
                'id'    => 37,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 38,
                'title' => 'question_create',
            ],
            [
                'id'    => 39,
                'title' => 'question_edit',
            ],
            [
                'id'    => 40,
                'title' => 'question_show',
            ],
            [
                'id'    => 41,
                'title' => 'question_delete',
            ],
            [
                'id'    => 42,
                'title' => 'question_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
