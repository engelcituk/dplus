<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();// limpio la tabla

        $cliente = new Category;
        $cliente->name="Sky/VeTV";
        $cliente->save();

        $cliente = new Category;
        $cliente->name="Recargas";
        $cliente->save();

        $cliente = new Category;
        $cliente->name="Internet";
        $cliente->save();

        $cliente = new Category;
        $cliente->name="Crédito";
        $cliente->save();

        $cliente = new Category;
        $cliente->name="Abarrotes";
        $cliente->save();
    }
}
