<?php

use Illuminate\Database\Seeder;

class ingredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->insert(
            [
            'name' => 'Nasi 600 gr',
            'stock' => 100,
            'expiryDate' => '20180101',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
            'name' => 'Daging Ayam 125 gr',
            'stock' => 100,
            'expiryDate' => '20180105',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]

    );
    }
}
