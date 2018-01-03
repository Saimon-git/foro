<?php

use App\User;
use App\Token;
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends FeaturesTestCase
{
    
    function test_a_user_can_create_an_account()
    {
        Mail::fake();
        $this->visitRoute('register')
                ->type('simon@styde.net', 'email')
                ->type('saimondev', 'username')
                ->type('Simon', 'first_name')
                ->type('Montoya', 'last_name')
                ->press('Registrate');
        
        $this->seeInDatabase('users', [
            'email' => 'simon@styde.net',
            'username' => 'saimondev',
            'first_name' => 'Simon',
            'last_name' => 'Montoya',
        ]);

        $user = User::first();

        $this->seeInDatabase('tokens',[
            'user_id' => $user->id
        ]);

        $token = Token::where('user_id',$user->id)->firstOrFail();

        Mail::assertSent(TokenMail::class, function($mail) use($token,$user){
            return $mail->hasTo($user) && $mail->token->id = $token->id;
        });

        //return;
        $this->seeRouteIs('register_confirmation')
            ->see('Gracias por registrarte')
            ->see('Enviamos a tu email un enlace para que inicies sesion');
    }
}
