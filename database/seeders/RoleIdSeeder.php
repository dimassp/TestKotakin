<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = User::query()
            ->where('email', 'test@example.com')
            ->first();

        $role_admin = Role::query()
            ->where('code', 'ADMIN')
            ->first();

        if(!is_null($model) && !is_null($role_admin)) {
            $model->role_id = $role_admin->id;
            $model->save();
        }
    }
}
