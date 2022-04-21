<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [[
            'name'=> 'super_admin',
            'email'=> 'super_admin@gmail.com',
            'password'=> bcrypt('super_admin1234'),
            'role'=> 'super_admin',
            
        ],
        [
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('admin1234'),
            'role'=> 'admin',
        ]
    ];

        DB::table('users')->insert($users);
        
    }
}
