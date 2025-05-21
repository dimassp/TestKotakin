<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert(
            [
                [
                    'name' => 'Admin',
                    'code' => 'ADMIN',
                    'access_control' => json_encode([
                        [
                            'ACCESS_DASHBOARD',
                            'ACCESS_USER_LIST',
                            'ACCESS_USER_ADD',
                            'ACCESS_USER_DELETE',
                            'ACCESS_USER_DETAIL',
                            'ACCESS_ROLE_LIST',
                            'ACCESS_ROLE_ADD',
                            'ACCESS_ROLE_DELETE',
                            'ACCESS_ROLE_DETAIL',
                        ]
                    ])
                ],
                [
                    'name' => 'User',
                    'code' => 'USER',
                    'access_control' => json_encode([
                        [
                            'ACCESS_DASHBOARD',
                            'ACCESS_ROLE_LIST',
                            'ACCESS_ROLE_ADD',
                            'ACCESS_ROLE_DELETE',
                            'ACCESS_ROLE_DETAIL',
                        ]
                    ])
                ],
            ]
        );
    }
}
