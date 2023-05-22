<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('class')->insert([[
            'name' => '一班',
            'created_at' => time(),
            'updated_at' => time(),
            'deleted_at' => '0',
        ], [
            'name' => '二班',
            'created_at' => time(),
            'updated_at' => time(),
            'deleted_at' => '0',
        ]]);
        DB::table('student')->insert([[
            'name' => 'bob',
            'age' =>10,
            'class_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            'deleted_at' => '0',
        ], [
            'name' => 'alice',
            'age' =>10,
            'class_id' => 2,
            'created_at' => time(),
            'updated_at' => time(),
            'deleted_at' => '0',
        ]]);
    }
}
