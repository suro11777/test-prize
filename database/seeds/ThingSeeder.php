<?php

use Illuminate\Database\Seeder;

class ThingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('things')->delete();
        $data = [];
        for ($i = 0; $i < 50; $i ++){
            $data[$i] = [
                'id' => $i+1,
                'name' => 'item'.$i,
                'count' => $i * 10,
                'prize_id' => 3,
            ];
        }
        \DB::table('things')->insert($data);
    }
}
