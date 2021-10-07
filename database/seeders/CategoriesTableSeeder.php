<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Mirim – Até 12 anos',
            'Juvenil – 13 a 14 anos',
            'Júnior – 15 a 18 anos',
            'Expert – 19 a 29 anos',
            'Master A – 30 a 34 anos',
            'Master B – 35 a 39 anos',
            'Master C – 40 a 49 anos',
            'Master D – 50+ anos',
            'Elite Masculino',
            'Feminino Open',
            'E-bike Elite',
            'E-bike Feminino Open',
            'E-bike Master 1 – Até 39 anos',
            'E-bike Master 2 – 40 a 49 anos',
            'E-bike Master 3 – 50 + anos',
            'E-Bike SL Open'
         ];


         foreach ($categories as $category) {
            EventCategory::create(['name' => $category]);
       }
    }
}
