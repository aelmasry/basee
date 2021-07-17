<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 => array (
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'web',
                'default' => 0,
                'created_at' => Now(),
                'updated_at' => Now(),

            ),
            1 => array (
                'id' => 2,
                'name' => 'manager',
                'guard_name' => 'web',
                'default' => 0,
                'created_at' => Now(),
                'updated_at' => Now(),

            ),
            2 => array(
                'id' => 3,
                'name' => 'user',
                'guard_name' => 'web',
                'default' => 1,
                'created_at' => Now(),
                'updated_at' => Now(),

            ),
        ));


    }
}