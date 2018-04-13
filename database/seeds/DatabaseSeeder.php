<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('admin_menu')->insert(
            [
                'id' => 10,
                'parent_id' => 0,
                'order' => 8,
                'title' => '用户',
                'icon' => 'fa-group',
                'uri' => 'users',
                'created_at' => \Carbon\Carbon::now()->toDateString(),
                'updated_at' => \Carbon\Carbon::now()->toDateString()
            ]
    );
        DB::table('admin_menu')->insert(
            [
                'id' => 11,
                'parent_id' => 0,
                'order' => 10,
                'title' => '话题',
                'icon' => 'fa-anchor',
                'uri' => 'topics',
                'created_at' => \Carbon\Carbon::now()->toDateString(),
                'updated_at' => \Carbon\Carbon::now()->toDateString()
            ]
        );
        DB::table('admin_menu')->insert(
            [
                'id' => 12,
                'parent_id' => 0,
                'order' => 9,
                'title' => '问题',
                'icon' => 'fa-mortar-board',
                'uri' => 'questions',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        );
    }
}
