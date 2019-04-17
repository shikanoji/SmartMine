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
            'name' => 'admin',
            'email' => 'kashijino@gmail.com',
            'password' => bcrypt('123456'),
            'roles' => 'ROLE_ADMIN',
        ]);
    }
}
