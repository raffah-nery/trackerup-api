<?php
namespace App\Controllers;

use App\Models\User;

class LoginController
{
    public function post()
    {
        $data = json_decode(file_get_contents('php://input') , true);
        if (empty($data))
        {
            $data = $_POST;
        }
        return User::selectByEmail($data["email"]);
    }
}

