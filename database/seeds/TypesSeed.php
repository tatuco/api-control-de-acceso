<?php

use Illuminate\Database\Seeder;

class TypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name' => 'Tag',
            'ent_id' => 1,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Qr',
            'ent_id' => 1,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);

        DB::table('types')->insert([
            'name' => 'Camara',
            'ent_id' => 3,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Balanza',
            'ent_id' => 3,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Antena',
            'ent_id' => 3,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Brazo',
            'ent_id' => 3,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);

        DB::table('types')->insert([
            'name' => 'Entrada',
            'ent_id' => 4,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Salida',
            'ent_id' => 4,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Emergencia',
            'ent_id' => 4,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);

        DB::table('types')->insert([
            'name' => 'Directivo',
            'ent_id' => 5,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Socio',
            'ent_id' => 5,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Usuario',
            'ent_id' => 5,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Invitado',
            'ent_id' => 5,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Afiliado',
            'ent_id' => 5,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);

        DB::table('types')->insert([
            'name' => 'Camion',
            'ent_id' => 6,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Vagoneta',
            'ent_id' => 6,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Gandola',
            'ent_id' => 6,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Camioneta',
            'ent_id' => 6,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
        DB::table('types')->insert([
            'name' => 'Carro',
            'ent_id' => 6,
            'acc_id' => 1,
            'created_at'=> new DateTime,
        ]);
    }
}
