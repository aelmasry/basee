<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Ali Salem',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'remember_token' =>  bcrypt(time()),
                'created_at' => Now(),
                'updated_at' => Now(),
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Test',
                'email' => 'test@admin.com',
                'password' => bcrypt('password'),
                'remember_token' =>  bcrypt(time()),
                'created_at' => Now(),
                'updated_at' => Now(),
            ),
        ));

    }
}
