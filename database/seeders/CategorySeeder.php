<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            [
                'name' => 'お弁当',
                'sort_order' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'おかずのみ',
                'sort_order' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'サイドメニュー',
                'sort_order' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'イベント用',
                'sort_order' => 4,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
