<?php

namespace Database\Seeders;

use App\Models\EventModality;
use Illuminate\Database\Seeder;

class ModalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modalities = [
            'Enduro',
            'XCO',
            'XC',
            'Down Hill',
            'Dirt',
            'BMX',
            'Bicicross',
            'Contra Relógio',
            'Speed',
            'Infantil'
         ];


         foreach ($modalities as $modality) {
            EventModality::create(['name' => $modality]);
       }
    }
}
