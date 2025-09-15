<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission; // Assuming you have a Permission model
use App\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $superAdminUser = User::where('user_type', 1)->first();
        $superAdminRole = Role::where('id', 1)->first();
        $permissions = Permission::whereNotIn('slug',['specific-unit','my-content'])->get();
        $superAdminRole->permissions()->detach($permissions);
        $superAdminRole->permissions()->attach($permissions);


    }
}
