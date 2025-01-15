<?php

namespace App\Custom;
use app\Models\User;

class Jtw
{
     public static function validate()
     {

     }

     public static function create(User $data)
     {
        $key = $_ENV['JWT_KEY'];

        $payload = [
            'exp' => time() + 1800,
            'ia' => time(),
            'data' => $data
        ];

        return JWT::enconde($payload, $key, 'HS256');
}
}