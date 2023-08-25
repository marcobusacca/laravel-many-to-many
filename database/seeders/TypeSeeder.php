<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Front-End', 'Back-End', 'Design', 'DevOps'];

        foreach($types as $item){

            $type = new Type();

            $type->name = $item;

            $type->slug = $type->generateSlug($item);

            $type->save();
        }
    }
}
