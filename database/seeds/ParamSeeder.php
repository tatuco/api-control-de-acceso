<?php

use Illuminate\Database\Seeder;

class ParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('params')->insert([
            'par_cod'=> 'UPLOAD_IMAGES',
            'par_tit'=>'UPLOAD_IMAGES',
            'par_key' => 'UPLOAD_IMAGES',
            'par_val'=>'/opt/AccessControl/images/',
            'par_des'=>'UPLOAD_IMAGES',
            'created_at'=> new DateTime
        ]);
    }
}
