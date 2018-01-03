<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{
    
    public function run()
    {
        factory(Post::class, 100)->create();
    }
}
