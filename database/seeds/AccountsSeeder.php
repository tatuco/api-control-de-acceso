<?php

use Illuminate\Database\Seeder;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'acc_enc' => "zippyttech",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'acc_des' => "Cuenta de prueba",
            'acc_dir' => 'panama',
            'acc_mai' => 'sysadmin@zippyttech.com',
            'acc_ima'=> 'imagen',
            'acc_nom'=> 'access',
            'acc_ruc'=> 'access',
            'acc_pho'=> '028 34232324',
            'acc_web'=> 'access.com',
            'acc_act'=> true
        ]);
    }
}
