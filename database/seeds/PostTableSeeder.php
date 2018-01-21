<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class PostTableSeeder extends Seeder
{
    
    public function run()
    {
        $categories = Category::select('id')->get();
        foreach(range(1,100) as $i){
            factory(Post::class)->create([
                'category_id' => $categories->random()->id
            ]);
        };
        
    }
}
