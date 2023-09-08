<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');
        $this->addRoles();
        $this->addPermissions();
    }

    protected function addRoles()
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Admin',
            ],
            [
                'name' => 'super-user',
                'description' => 'Super User',
            ],
        ];

        foreach ($roles as $role){
            Role::query()->updateOrCreate(['name' => $role['name']], $role);
        }
    }

    protected function addPermissions()
    {
        $permissions = [
            // User Management
            [
                'name' => 'user-index',
                'description' => 'User can list Users'
            ],
            [
                'name' => 'user-show',
                'description' => 'User can show User'
            ],
            [
                'name' => 'user-create',
                'description' => 'User can create User'
            ],
            [
                'name' => 'user-edit',
                'description' => 'User can edit User'
            ],
            [
                'name' => 'user-delete',
                'description' => 'User can delete User'
            ],
        ];

        foreach ($permissions as $permission){
            Permission::query()->updateOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
