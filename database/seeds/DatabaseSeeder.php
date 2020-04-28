<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // sino deshabilito esto me marca error de constraints

        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(DaysPeriodsTableSeeder::class);
        $this->call(ServiciosTableSeeder::class);
        $this->call(ClientesTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // lo vuelvo a activar

    }
}
