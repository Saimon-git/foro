<?php

use App\{Token,User};
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Mail\Mailable;


class TokenMailTest extends FeaturesTestCase
{
    /**
     * @test
     */
    function it_sends_a_link_with_the_token()
    {
        //Having
        $user = new User([
            'first_name' => 'Simon',
            'last_name'  => 'Montoya',
            'email'      => 'simon@dev.net',
        ]);

        $token = new Token([
            'token' => 'this-is-a-token',
            'user' => $user
        ]);

        $this->open(new TokenMail($token))
                ->seeLink($token->url, $token->url);
    }

    protected function open(Mailable $mailable)
    {
        $transport = Mail::getSwiftMailer()->getTransport();

        $transport->flush();

        Mail::send($mailable);
        
        $message = $transport->messages()->first();

        //dd($message->getBody()); this is preview the body message

        $this->crawler  = new Crawler($message->getBody());        

        return $this;
    }
}
