<?php

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time_days')->insert([
            'name' => 'Lunes',
            'created_at'=> new DateTime,
        ]);

        DB::table('time_days')->insert([
            'name' => 'Martes',
            'created_at'=> new DateTime,
        ]);

        DB::table('time_days')->insert([
            'name' => 'Miercoles',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_days')->insert([
            'name' => 'Jueves',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_days')->insert([
            'name' => 'Viernes',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_days')->insert([
            'name' => 'Sabado',
            'created_at'=> new DateTime,
        ]);
        DB::table('time_days')->insert([
            'name' => 'Domingo',
            'created_at'=> new DateTime,
        ]);

    }
}
