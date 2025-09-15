<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Request $request): void
    {
        $faker = Faker::create();

        // Super Admin User
        $permissions = Permission::all();
        $superAdminRole = Role::where('slug', 'super-admin')->first();
        $superAdminUser = User::where('email', 'superadmin@gmail.com')->first();

        if (empty($superAdminUser)) {
            $superAdminUser = new User();
            $superAdminUser->uuid = $faker->uuid;
            $superAdminUser->name = 'Super Admin';
            $superAdminUser->username = 'SuperAdmin';
            $superAdminUser->user_type = 1;
            $superAdminUser->email = 'superadmin@gmail.com';
            $superAdminUser->phone_code = 91;
            $superAdminUser->mobile_number = 9876543210;
            $superAdminUser->password = bcrypt('superadmin');
            $superAdminUser->original_password = 'superadmin';
            $superAdminUser->country_id = 101;
            $superAdminUser->state_id = 41;
            $superAdminUser->city_id = 5583;
            $superAdminUser->registration_ip = $request->getClientIp();
            $superAdminUser->is_active = 1;
            $superAdminUser->save();
        }

        $superAdminUser->roles()->sync($superAdminRole);
        $superAdminUser->permissions()->sync($permissions);
        $superAdminRole->permissions()->sync($permissions);


    }
}
