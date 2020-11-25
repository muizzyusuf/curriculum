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
            'name' => 'Muizz Admin',
            'email' => 'abdelmuizz.yusuf@hotmail.com',
            'password' => Hash::make('password'), 
        ]);

        $user = User::create([
            'name' => 'Muizz User',
            'email' => 'abdelmuizz.yusuf@gmail.com',
            'password' => Hash::make('password'), 
        ]);


        $admin->roles()->attach($adminRole);
        $admin->roles()->attach($userRole);
        $user->roles()->attach($userRole);


    }
}
