<?php

namespace Database\Seeders;

use App\Models\Locale;
use Illuminate\Database\Seeder;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = ['ru', 'en', 'ka'];
        $name = ['Русский', 'Английский', 'Грузинский'];
        $shortName = ['ru', 'en', 'ge'];
        $image = ['ru.png', 'en.png', 'ka.png'];
        $visibility = [1,1,1];
        
        for($i = 0; $i < count($name); $i++) {
            $locale = new Locale();
            $locale->value = $value[$i];
            $locale->name = $name[$i];
            $locale->short_name = $shortName[$i];
            $locale->image = $image[$i];
            $locale->visibility = $visibility[$i];
            $locale->save();
        }

    }
}
