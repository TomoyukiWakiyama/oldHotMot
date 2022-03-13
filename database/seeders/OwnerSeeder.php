<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('owners')->insert([
            [
                'name' => 'owner1',
                'email' => 'owner1@fake.com',
                'password' => Hash::make('password'),
                'created_at' => '2022/02/02 12:12:12',
            ],
            [
                'name' => 'owner2',
                'email' => 'owner2@fake.com',
                'password' => Hash::make('password'),
                'created_at' => '2022/02/02 12:12:12',
            ],
            [
                'name' => 'owner3',
                'email' => 'owner3@fake.com',
                'password' => Hash::make('password'),
                'created_at' => '2022/02/02 12:12:12',
            ],
        ]);
    }
}
