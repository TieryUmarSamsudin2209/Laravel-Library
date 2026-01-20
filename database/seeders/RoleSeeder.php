<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                "name" => "admin",
                "email" => "admin@mail.com",
                "password" => bcrypt("admin1234!")
            ],
            [
                "name" => "member",
                "email" => "member@mail.com",
                "password" => bcrypt("member1234!")
            ],
        ];

        $users = User::insert($user);
        $role = [
            [
                "role_name" => "admin"
            ],
            [
                "role_name" => "member"
            ],
        ];

        Role::insert($role);

        echo "CREATE USER SUCCESS: " . $users;

        // foreach($users as $use) {
        //     if($use['id'] == 5) {
        //         RoleUser::create([
        //             "user_id" => $use['id'],
        //             "role_id" => $use['id']
        //         ]);
        //         return;
        //     }
        //     if($use['id'] == 6) {
        //         RoleUser::create([
        //             "user_id" => $use['id'],
        //             "role_id" => $use['id']
        //         ]);
        //     }
        // }
    }
}
