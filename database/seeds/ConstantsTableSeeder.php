<?php

use App\Category;
use Illuminate\Database\Seeder;

class ConstantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Developer'
        ]);

        Category::create([
            'name' => 'News'
        ]);

        Category::create([
            'name' => 'Social'
        ]);

    }
}
