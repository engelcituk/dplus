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
        $categoria->name="Servicios TV";
        $categoria->save();

        $categoria = new Category;
        $categoria->name="Servicios Internet";
        $categoria->save();

        $categoria = new Category;
        $categoria->name="Servicios recarga";
        $categoria->save();

        $categoria = new Category;
        $categoria->name="Papelería";
        $categoria->save();
    }
}
