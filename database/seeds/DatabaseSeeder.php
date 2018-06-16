<?php

use App\Models\Inventary\Brand;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountsSeeder::class);
        $this->call(ParamSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(DaysTableSeeder::class);
        $this->call(HoursTableSeeder::class);
        $this->call(TimeCategoriesSeeder::class);
        $this->call(BlocksSeed::class);
        $this->call(CountrieSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(EntitiesSeed::class);
        $this->call(BrandVehicleSeeder::class);
        $this->call(ModelVehicleSeeder::class);
        $this->call(StatusSeed::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RegionalConfigurationSeeder::class);
        $this->call(TypesSeed::class);


    }
}
