<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        // $user = User::find(2); //Id Admin User

        $role = Role::create(['name' => 'Administrator']);
        $permissions = Permission::pluck('id','name')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $role = Role::create(['name' => 'Manager']);
        $role->syncPermissions(['manager'=>$permissions['manager']]);
        $user->assignRole([$role->id]);
    }
}
