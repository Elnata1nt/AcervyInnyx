<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Auth extends Controller
{
    public function auth( Request $request )
    {
       $user = User::where('email', $request->email)->first();

       if(!$user) {
        response( ) -> json('not authorizer', 401);
       }

       if(!password_verify($request->password, $user->password)) {
        response( ) -> json('not authorizer', 401);
       }

       $token = Jwt::create($user);

       return response() ->json([
        'token' => $token,
        'user'=> [
            'firstName'=> $user->firstName,
            'lastName'=> $user->lastName
        ]
        ]);
    }
}
