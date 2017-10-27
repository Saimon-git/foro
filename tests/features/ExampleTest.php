<?php

use App\User;

class ExampleTest extends FeaturesTestCase
{
    
    /**
     * A basic functional test example.
     *
     * @return void
     */
    function test_basic_example()
    {

        $user = factory(User::class)->create([
                'name'=> 'Simon Montoya',
                'email' => 'simonmontoya19@gmail.com',
            ]);

        $this->actingAs($user,'api')
             ->visit('api/user')
             ->see('Simon Montoya')
             ->see('simonmontoya19@gmail.com');
    }
}
