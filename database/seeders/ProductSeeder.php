<?php

namespace Database\Seeders;

use App\Helpers\Helper;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed products table
     *
     * @return void
     */
    public function run()
    {
        $name = ['Амброксол', 'М2-Гино', 'Гоназа Ампулы', 'Аргумел Коби', 'Бекладейм', 'Би-Септин-Нео', 'Аргумел Шампунь', 'Пандемон'];
        $description = '<p>Амброксол (активный метаболит бромгексина) является муколитическим средством, который улучшает реологические свойства мокроты, уменьшает ее вязкость и адгезивные свойства, что способствует ее выведению из дыхательных путей.</p>';
        $composition = '<p>Каждые 5 мл содержат: амброксола гидрохлорид BP 15 мг.</p>';
        $testimony = '<p>Амброксол применяется при заболеваниях дыхательных путей с выделением вязкой мокроты, и при затруднении отделения мокроты: </p>
        <ul>
        <li>острые и хронические бронхиты;</li>
        <li>пневмония;</li>
        <li>бронхиальная астма;</li>
        <li>бронхоэктатическая болезнь.</li>
        </ul>';
        $use = '<p>Внутрь, сироп Амброксол, принимают после еды с достаточным количеством жидкости (например, вода, сок или чай) с помощью прилагаемого мерного стаканчика.
        Обычно используются следующие дозировки:</p>
        <p>Детям до 2-х лет по 7,5мг – 2 раза в день (15 мг/сутки);</p>
        <p>Детям от 2 до 6 лет по 7,5 мг – 3 раза в день (22,5 мг/сутки);</p>
        <p>Дети от 6 до 12 лет по 15 мг – 2-3 раза в день (30-45 мг/сутки);</p>
        <p>Взрослым и подросткам в первые 2-3 дня лечения принимать по 30 мг – 3 раза в сутки (90 мг/ сутки), в последующие дни 2 раза в день (60 мг/сутки);</p>
        <p>Лечение детей до 2-х лет проводится только под контролем врача;</p>
        <p>Во время приема сиропа Амброксол, рекомендуется обильное питье; Не рекомендуется применять без врачебного назначения более, чем в течение 4-5 дней.</p>';


        for($i = 0; $i < count($name); $i++) {
            $product = new Product();
            $product->ru_name = $name[$i];
            $product->en_name = $name[$i];
            $product->ka_name = $name[$i];

            $product->url = Helper::transliterateIntoLatin($name[$i]);
            $product->prescription = rand(0,1);
            $product->form_id = rand(1,8);
            if($i < 3) {
                $product->highlight_in_filter = true;
            }
            $product->form_id = rand(1,8);

            $product->ru_image = Helper::transliterateIntoLatin($name[$i]) . '.png';
            $product->en_image = Helper::transliterateIntoLatin($name[$i]) . '.png';
            $product->ka_image = Helper::transliterateIntoLatin($name[$i]) . '.png';

            $product->ru_instruction = Helper::transliterateIntoLatin($name[$i]) . '.pdf';
            $product->en_instruction = Helper::transliterateIntoLatin($name[$i]) . '.pdf';
            $product->ka_instruction = Helper::transliterateIntoLatin($name[$i]) . '.pdf';

            $product->ru_obtain_link = 'https://salomat.tj/';
            $product->en_obtain_link = 'https://salomat.tj/';
            $product->ka_obtain_link = 'https://salomat.tj/';

            $product->ru_amount = '5 МЛ';
            $product->ka_amount = '5 МЛ';
            $product->en_amount = '5 МЛ';

            $product->ru_description = $description;
            $product->en_description = $description;
            $product->ka_description = $description;

            $product->ru_composition = $composition;
            $product->en_composition = $composition;
            $product->ka_composition = $composition;

            $product->ru_testimony = $testimony;
            $product->ka_testimony = $testimony;
            $product->en_testimony = $testimony;

            $product->ru_use = $use;
            $product->en_use = $use;
            $product->ka_use = $use;
            $product->save();

            $product->categories()->attach(rand(1,2));
            $product->symptoms()->attach(rand(1,8));
        }
    }
}
