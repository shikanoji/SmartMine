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
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'role' => 'ROLE_ADMIN',
                'status' => '1',
            ],
            [
                'name' => 'nguoidung',
                'username' => 'nguoidung',
                'password' => bcrypt('123456'),
                'role' => 'ROLE_MEMBER',
                'status' => '1',  
            ]
        ]);
    }
}
