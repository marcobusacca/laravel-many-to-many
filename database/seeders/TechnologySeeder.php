<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['HTML', 'CSS', 'JavaScript', 'VueJS', 'Vite', 'PHP', 'Laravel'];

        foreach($technologies as $item){

            $technology = new Technology();

            $technology->name = $item;

            $technology->slug = $technology->generateSlug($item);

            $technology->save();
        }
    }
}
