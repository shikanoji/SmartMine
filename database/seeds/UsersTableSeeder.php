<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'ROLE_ADMIN',
            ],
            [
                'name' => 'nguoidung',
                'email' => 'nguoidung@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'ROLE_MEMBER',  
            ]
        ]);
    }
}
