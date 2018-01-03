<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminTableSeeder extends Seeder
{
    
    public function run()
    {
        factory(User::class)->create([
            'first_name' => 'Simon',
            'last_name' => 'Montoya',
            'username' => 'saimondev',
            'email' => 'simon@styde.net',
            'role' => 'admin,'
        ]);
    }
}
