<?php

use App\Token;
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;

class RequestTokenTest extends FeaturesTestCase
{
    function test_a_guest_user_can_request_a_token()
    {
        //Having
        Mail::fake();
        
        $user = $this->defaultUser(['email' => 'admin@styde.net']);
        

        //When
        $this->visitRoute('token')
            ->type('admin@styde.net', 'email')
            ->press('Solicitar token');

        //Then: a new token create in database
        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token,'A token was not created');

        //And send to user
        Mail::assertSentTo($user,TokenMail::class, function($mail) use($token){
            return $mail->token->id === $token->id;
        });
 
        $this->dontSeeIsAuthenticated();

        $this->see('Enviamos a tu email un enlace para que inicies sesion');
    }

    function test_a_guest_user_can_request_a_token_without_an_email()
    {
        //Having
        Mail::fake();
        
        
        //When
        $this->visitRoute('token')                
                ->press('Solicitar token');

        //Then: a new token create in database
        $token = Token::first();

        $this->assertNull($token,'A token was created');

        //And send to user
        Mail::assertNotSent(TokenMail::class);
 
        $this->dontSeeIsAuthenticated();

        $this->seeErrors([
            'email'=> 'El campo correo electrónico es obligatorio',
        ]);
    }

    function test_a_guest_user_can_request_a_token_an_invalid_email()
    {
        //When
        $this->visitRoute('token')
                ->type('Simon','email')
                ->press('Solicitar token');

        

        $this->seeErrors([
            'email'=> 'correo electrónico no es un correo válido',
        ]);
    }

    function test_a_guest_user_can_request_a_token_with_a_non_existen_email  ()
    {
        //Having
        $this->defaultUser(['email' => 'admin@styde.net']);
        
        //When
        
        $this->visitRoute('token')
                ->type('Simon@styde.net','email')
                ->press('Solicitar token');

        

        $this->seeErrors([
            'email'=> 'Este correo electrónico no existe',
        ]);
    }
}
