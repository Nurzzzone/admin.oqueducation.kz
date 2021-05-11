<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     *  Role permissions
     * 
     * @var array
     */
    protected $rolePermission = [
        'superAdmin' => [
            'backend-view',
            'frontend-view',
            'users-view'
        ],
        'moderator' => [
            'backend-view',
            'frontend-view',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'superAdmin',
            'guard_name' => 'web',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ])->givePermissionTo($this->rolePermission['superAdmin']);

        Role::create([
            'name' => 'moderator',
            'guard_name' => 'web',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ])->givePermissionTo($this->rolePermission['moderator']);
    }
}
