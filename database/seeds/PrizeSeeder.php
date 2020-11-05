<?php

use Illuminate\Database\Seeder;

class PrizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('prizes')->delete();

        \DB::table('prizes')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'type' => 1,
                    'name' => 'money',
                    'is_stock' => true,
                    'count' => 5000000,
                ),
            1 =>
                array (
                    'id' => 2,
                    'type' => 2,
                    'name' => 'point',
                    'is_stock' => true,
                    'count' => 50000,
                ),
            2 =>
                array (
                    'id' => 3,
                    'type' => 3,
                    'name' => 'thing',
                    'is_stock' => true,
                    'count' => 12250,
                ),
        ));
    }
}
