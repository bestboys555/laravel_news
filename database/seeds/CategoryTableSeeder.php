<?php

use Illuminate\Database\Seeder;
use App\News_category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorys = [
            ['id' => 1, 'name' => 'News'],
            ['id' => 2, 'name' => 'Sports'],
         ];

        foreach ($categorys as $category) {
            News_category::create($category);
        }
    }
}
