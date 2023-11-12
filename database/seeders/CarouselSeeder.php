<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['Юнифен', 'Жасмед'];
        $description = 'Юнифен оказывает анальгезирующее, жаропонижающее и противовоспалительное действие.';
        $image = ['1.png', '2.png'];

        for($i=0; $i<count($title); $i++) {
            $item = new Carousel();
            $item->ru_title = $title[$i];
            $item->en_title = $title[$i];
            $item->ka_title = $title[$i];

            $item->ru_description = $description;
            $item->en_description = $description;
            $item->ka_description = $description;

            $item->ru_image = $image[$i];
            $item->en_image = $image[$i];
            $item->ka_image = $image[$i];

            $item->product_id = 1;
            $item->url = uniqid();

            $item->save();
        }
    }
}
