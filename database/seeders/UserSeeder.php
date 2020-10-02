<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //User::delete();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('role','administrator')->first();
        $userRole = Role::where('role','user')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), 
        ]);

        $user1 = User::create([
            'name' => 'Generic User1',
            'email' => 'user1@user.com',
            'password' => Hash::make('password'), 
        ]);

        $user2 = User::create([
            'name' => 'Generic User2',
            'email' => 'user2@user.com',
            'password' => Hash::make('password'), 
        ]);

        $admin->roles()->attach($adminRole);
        $user1->roles()->attach($userRole);
        $user2->roles()->attach($userRole);


    }
}
