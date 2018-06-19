<?php

use Illuminate\Database\Seeder;

class StatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('status')->insert([
            'name' => 'Activo',
            'ent_id' => 5,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('status')->insert([
            'name' => 'Bloqueado',
            'ent_id' => 5,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('status')->insert([
            'name' => 'Moroso',
            'ent_id' => 2,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('status')->insert([
            'name' => 'Vigente',
            'ent_id' => 2,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('status')->insert([
            'name' => 'Vencido',
            'ent_id' => 2,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('status')->insert([
            'name' => 'Suspendido',
            'ent_id' => 2,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('status')->insert([
            'name' => 'Permitido',
            'ent_id' => 1,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);

        DB::table('status')->insert([
            'name' => 'No Permitido',
            'ent_id' => 1,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
    }
}
