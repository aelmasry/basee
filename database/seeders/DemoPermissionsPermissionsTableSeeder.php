<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoPermissionsPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'users.profile',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:02',
                'updated_at' => '2020-03-29 14:58:02',

            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'dashboard',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:02',
                'updated_at' => '2020-03-29 14:58:02',

            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'medias.create',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:02',
                'updated_at' => '2020-03-29 14:58:02',

            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'medias.delete',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:02',
                'updated_at' => '2020-03-29 14:58:02',

            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'medias',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:03',
                'updated_at' => '2020-03-29 14:58:03',

            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'permissions.index',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:03',
                'updated_at' => '2020-03-29 14:58:03',

            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'permissions.edit',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:03',
                'updated_at' => '2020-03-29 14:58:03',

            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'permissions.update',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:03',
                'updated_at' => '2020-03-29 14:58:03',

            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'permissions.destroy',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:03',
                'updated_at' => '2020-03-29 14:58:03',

            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'roles.index',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:03',
                'updated_at' => '2020-03-29 14:58:03',

            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'roles.edit',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:03',
                'updated_at' => '2020-03-29 14:58:03',

            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'roles.update',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:03',
                'updated_at' => '2020-03-29 14:58:03',

            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'roles.destroy',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:03',
                'updated_at' => '2020-03-29 14:58:03',

            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'users.login-as-user',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:04',
                'updated_at' => '2020-03-29 14:58:04',

            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'users.index',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:04',
                'updated_at' => '2020-03-29 14:58:04',

            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'users.create',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:04',
                'updated_at' => '2020-03-29 14:58:04',

            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'users.store',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:04',
                'updated_at' => '2020-03-29 14:58:04',

            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'users.show',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:04',
                'updated_at' => '2020-03-29 14:58:04',

            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'users.edit',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:04',
                'updated_at' => '2020-03-29 14:58:04',

            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'users.update',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:04',
                'updated_at' => '2020-03-29 14:58:04',

            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'users.destroy',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:04',
                'updated_at' => '2020-03-29 14:58:04',

            ),
            35 =>
            array (
                'id' => 36,
                'name' => 'categories.index',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:05',
                'updated_at' => '2020-03-29 14:58:05',

            ),
            36 =>
            array (
                'id' => 37,
                'name' => 'categories.create',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:05',
                'updated_at' => '2020-03-29 14:58:05',

            ),
            37 =>
            array (
                'id' => 38,
                'name' => 'categories.store',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:05',
                'updated_at' => '2020-03-29 14:58:05',

            ),
            38 =>
            array (
                'id' => 39,
                'name' => 'categories.edit',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:05',
                'updated_at' => '2020-03-29 14:58:05',

            ),
            39 =>
            array (
                'id' => 40,
                'name' => 'categories.update',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:05',
                'updated_at' => '2020-03-29 14:58:05',

            ),
            40 =>
            array (
                'id' => 41,
                'name' => 'categories.destroy',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:58:05',
                'updated_at' => '2020-03-29 14:58:05',

            ),
            157 =>
            array (
                'id' => 158,
                'name' => 'permissions.create',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:59:15',
                'updated_at' => '2020-03-29 14:59:15',

            ),
            158 =>
            array (
                'id' => 159,
                'name' => 'permissions.store',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:59:15',
                'updated_at' => '2020-03-29 14:59:15',

            ),
            159 =>
            array (
                'id' => 160,
                'name' => 'permissions.show',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:59:15',
                'updated_at' => '2020-03-29 14:59:15',

            ),
            160 =>
            array (
                'id' => 161,
                'name' => 'roles.create',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:59:15',
                'updated_at' => '2020-03-29 14:59:15',

            ),
            161 =>
            array (
                'id' => 162,
                'name' => 'roles.store',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:59:15',
                'updated_at' => '2020-03-29 14:59:15',

            ),
            162 =>
            array (
                'id' => 163,
                'name' => 'roles.show',
                'guard_name' => 'web',
                'created_at' => '2020-03-29 14:59:16',
                'updated_at' => '2020-03-29 14:59:16',

            ),
        ));


    }
}
