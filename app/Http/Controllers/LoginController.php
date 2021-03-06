<?php

namespace App\Http\Controllers;


use App\Token;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login($token)
    {
        $token = Token::findActive($token);

        if($token == null)
        {
            alert('Este enlace ya expiro, Por favor solicita otro', 'danger');
            return redirect()->route('token');
        }

        $token->login();

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();

        return redirect('/');
    }
}
