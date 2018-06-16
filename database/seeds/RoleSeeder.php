<?php
use Illuminate\Database\Seeder;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'=> 'Sysadmin',
            'slug'=>'Sysadmin',
            'description' => 'root del sistema',
            'acc_id' => 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('role_user')->insert([
            'user_id'=> 1,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('roles')->insert([
            'name'=> 'Admin',
            'slug'=>'Admin',
            'description' => 'administrador del sistema',
            'acc_id' => 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('role_user')->insert([
            'user_id'=> 2,
            'role_id'=> 2,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('roles')->insert([
            'name'=> 'Operador',
            'slug'=>'Operator',
            'description' => 'operador del sistema',
            'acc_id' => 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('role_user')->insert([
            'user_id'=> 3,
            'role_id'=> 3,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('roles')->insert([
            'name'=> 'Usuario',
            'slug'=> 'Usuario',
            'description' => 'usuario publico del sistema',
            'acc_id' => 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('role_user')->insert([
            'user_id'=> 4,
            'role_id'=> 4,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
    }
}