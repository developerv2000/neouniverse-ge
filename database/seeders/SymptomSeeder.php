<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Нарушения обмена веществ', 'Умственная отсталость', 'Нарушения психологического развития', 'Зрительные расстройства и слепота', 'Острая ревматическая лихорадка', 'Инфекции кожи и подкожной клетчатки', 'Врожденные аномалии [пороки развития] глаза, уха, лица и шеи', 'Термические и химические ожоги'];

        for($i = 0; $i < count($name); $i++) {
            $symptom = new Symptom();
            $symptom->ru_name = $name[$i];
            $symptom->en_name = $name[$i];
            $symptom->ka_name = $name[$i];
            $symptom->save();
            
        }
    }
}
