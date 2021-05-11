<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     *  Role permissions
     * 
     * @var array
     */
    protected $rolePermission = [
        'superAdmin' => [
            'frontend-view',
            'backend-view',
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
        User::create([
            'name' => 'superAdmin',
            'email' => 'superAdmin@admin.com',
            'password' => password_hash('secret', PASSWORD_DEFAULT),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ])->assignRole('superAdmin')
          ->givePermissionTo($this->rolePermission['superAdmin']);

        User::create([
            'name' => 'moderator',
            'email' => 'moderator@admin.com',
            'password' => password_hash('secret', PASSWORD_DEFAULT),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ])->assignRole('moderator')
          ->givePermissionTo($this->rolePermission['moderator']);
    }
}
