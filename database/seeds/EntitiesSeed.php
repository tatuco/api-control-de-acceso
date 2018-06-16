<?php

use Illuminate\Database\Seeder;

class EntitiesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entities')->insert([
            'name' => 'codes',
            'acc_id'=> 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('entities')->insert([
            'name' => 'contracts',
            'acc_id'=> 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('entities')->insert([
            'name' => 'divices',
            'acc_id'=> 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('entities')->insert([
            'name' => 'operations',
            'acc_id'=> 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('entities')->insert([
            'name' => 'users',
            'acc_id'=> 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('entities')->insert([
            'name' => 'vehicles',
            'acc_id'=> 1,
            'created_at'=> new DateTime,
        ]);
    }
}
