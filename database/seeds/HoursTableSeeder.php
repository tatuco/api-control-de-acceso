<?php

use Illuminate\Database\Seeder;

class HoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('time_hours')->insert([
            'hour' => '00',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '01',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '02',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '03',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '04',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '05',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '06',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '07',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '08',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '09',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '10',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '11',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '12',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '13',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '14',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '15',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '16',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '17',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '18',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '19',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '20',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '21',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '22',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_hours')->insert([
            'hour' => '23',
            'created_at'=> new DateTime,
        ]);


    }
}
