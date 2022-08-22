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
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'testadmin@infikeypro.tech',
            'role_id'=>'1',
            'gender'=>'male',
            'is_admin' => true,
            'phone' => '7874444107',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'test@infikeypro.tech',
            'phone' => '8785549872',
            'role_id'=>'3',
            'gender'=>'male',

            'is_admin' => false,
            'password' => bcrypt('password'),
        ]);
    }
}
