<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('menus')->insert([
            [
                'store_id' => 1,
                'name' => 'カツ丼',
                'information' => 'カツ丼 information',
                'price' => 500,
                'is_selling' => true,
                'sort_order' => 1,
                'category_id' => 1,
                'new_item' => false,
                'soon_over' => false,
                'small_serving' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'store_id' => 1,
                'name' => 'から揚げ弁当 おかずのみ',
                'information' => 'から揚げ弁当 information',
                'price' => 300,
                'is_selling' => true,
                'sort_order' => 2,
                'category_id' => 2,
                'new_item' => false,
                'soon_over' => false,
                'small_serving' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
