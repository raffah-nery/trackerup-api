<?php
namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function get($params = null)
    {
        if ($params)
        {
            return User::select($params);
        }
        if ($_GET["email"])
        {
            return User::selectByEmail($_GET["email"]);
        }
        return User::selectAll();
    }

    public function post()
    {
        $data = json_decode(file_get_contents('php://input') , true);
        if (empty($data))
        {
            $data = $_POST;
        }
        return User::insert($data);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}

