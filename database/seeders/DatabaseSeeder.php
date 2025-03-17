<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\Category::factory(10)->create()->each(function ($category) {
            $category->products()->saveMany(\App\Models\Product::factory(5)->make());
        });
        
    }
}
