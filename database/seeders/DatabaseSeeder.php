<?php

namespace Database\Seeders;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@mail.ru';
        $user->password = bcrypt('12345');
        $user->save();

        $this->call(ProductSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SymptomSeeder::class);
        $this->call(FormSeeder::class);
        $this->call(CarouselSeeder::class);
        $this->call(LocaleSeeder::class);
    }
}
