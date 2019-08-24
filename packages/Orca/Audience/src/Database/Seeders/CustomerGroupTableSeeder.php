<?php

namespace Orca\Audience\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AudienceGroupTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('audience_groups')->delete();

        DB::table('audience_groups')->insert([
            [
                'id' => 1,
                'code' => 'guest',
                'name' => 'Guest',
                'is_user_defined' => 0,
            ], [
                'id' => 2,
                'code' => 'general',
                'name' => 'General',
                'is_user_defined' => 0,
            ], [
                'id' => 3,
                'code' => 'wholesale',
                'name' => 'Wholesale',
                'is_user_defined' => 0,
            ]
        ]);
    }
}