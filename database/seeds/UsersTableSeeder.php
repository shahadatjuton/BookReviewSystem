<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'role_id'=> '1',
            'name'=> 'admin',
            'user_name' => 'admin',
            'email'=>'admin@gmail.com',
            'password' => bcrypt('admin123')

        ]);

        DB::table('users')->insert([
            'role_id'=> '2',
            'name'=> 'publisher',
            'user_name' => 'publisher',
            'email'=>'publisher@gmail.com',
            'password' => bcrypt('publisher123')

        ]);

        DB::table('users')->insert([
            'role_id'=> '3',
            'name'=> 'author',
            'user_name' => 'author',
            'email'=>'author@gmail.com',
            'password' => bcrypt('author123')

        ]);

        DB::table('users')->insert([
            'role_id'=> '4',
            'name'=> 'user',
            'user_name' => 'user',
            'email'=>'user@gmail.com',
            'password' => bcrypt('user123')

        ]);
    }
}
