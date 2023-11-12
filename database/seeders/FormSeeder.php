<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Таблетки', 'Сироп', 'Порошки', 'Ампулы', 'Спрей', 'Мазь', 'Гель', 'Глазные капли'];

        for($i = 0; $i < count($name); $i++) {
            $form = new Form();
            $form->ru_name = $name[$i];
            $form->en_name = $name[$i];
            $form->ka_name = $name[$i];
            $form->save();
        }
    }
}
