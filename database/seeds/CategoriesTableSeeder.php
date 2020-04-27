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

        $categoria = new Category;
        $categoria->name="Sky/VeTV";
        $categoria->save();

        $categoria = new Category;
        $categoria->name="Recargas";
        $categoria->save();

        $categoria = new Category;
        $categoria->name="Internet";
        $categoria->save();

        $categoria = new Category;
        $categoria->name="Crédito";
        $categoria->save();

        $categoria = new Category;
        $categoria->name="Abarrotes";
        $categoria->save();
    }
}
