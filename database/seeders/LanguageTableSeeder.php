<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name'        => 'English',
            'abbr'        => 'en',
            'native'    => 'English',
            'active'    => '1',
            'default'    => '1',
        ]);

        DB::table('languages')->insert([
            'name'        => 'Arabic',
            'abbr'        => 'ar',
            'native'    => 'العربية',
            'active'    => '0',
            'default'    => '0',
        ]);

        $this->command->info('Language seeding successful.');
    }
}
