<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
   
    public function run()
    {
        Category::create([
            'name' => 'Laravel',
            'slug' => 'laravel',
        ]);

        Category::create([
            'name' => 'PHP',
            'slug' => 'php',
        ]);

        Category::create([
            'name' => 'JavaScript',
            'slug' => 'javascript',
        ]);

        Category::create([
            'name' => 'Vue.js',
            'slug' => 'vue-js',
        ]);

        Category::create([
            'name' => 'CSS',
            'slug' => 'css',
        ]);

        Category::create([
            'name' => 'Sass',
            'slug' => 'sass',
        ]);

        Category::create([
            'name' => 'Git',
            'slug' => 'git',
        ]);

        Category::create([
            'name' => 'Otras tecnologias',
            'slug' => 'otras-tecnologias',
        ]);        
    }
}
