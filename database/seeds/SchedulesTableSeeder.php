<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
            'name' => 'Lunes',
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
    }
}
