<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\DemoPermissionsPermissionsTableSeeder;
use Database\Seeders\RoleHasPermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\LanguageTableSeeder;
use DB;
use File;
use Database\Seeders\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        @ini_set('memory_limit', '-1');

        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(DemoPermissionsPermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(LanguageTableSeeder::class);

        // $files = File::allFiles(__dir__ . '/sql_dump');

        // if(!empty($files)) {
        //     foreach ($files as $file) {
        //         // seed Dump sql
        //         DB::unprepared(file_get_contents($file->getPathName()));
        //     }
        // }
    }
}
