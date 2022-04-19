<?php

namespace Database\Seeders;

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
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('admin1234'),
            
        ]];

        DB::table('users')->insert($users);
        
    }
}
