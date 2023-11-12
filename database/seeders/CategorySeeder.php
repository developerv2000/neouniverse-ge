<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use App\Models\ProductsCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodCat = ['Аллергология', 'Антимикробные препараты', 'Витамины и минералы', 'Гематология', 'Гинекология', 'Глюкокортикостероиды', 'Дерматология', 'Дыхательная система'];

        for($i = 0; $i < count($prodCat); $i++) {
            $category = new ProductsCategory();
            $category->ru_name = $prodCat[$i];
            $category->en_name = $prodCat[$i];
            $category->ka_name = $prodCat[$i];
            $category->save();
        }


        $newsCat = ['Нанотехнологии', 'Полезные советы', 'Covid 19', 'Здоровый образ жизни', 'Укрепление иммунитета', 'Психотерапия', 'Эпидемиология', 'Спецпроекты'];

        for($i = 0; $i < count($newsCat); $i++) {
            $category = new NewsCategory();
            $category->ru_name = $newsCat[$i];
            $category->en_name = $newsCat[$i];
            $category->ka_name = $newsCat[$i];
            if($i < 3) {
                $category->highlight_in_filter = true;
            }
            $category->save();
        }
    }
}
