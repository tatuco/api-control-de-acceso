<?php

use Illuminate\Database\Seeder;

class CountrieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'cou_des' => 'Panama',
            'cou_uho' => 'GMT-5',
            'created_at'=> new DateTime,
        ]);
    }
}
