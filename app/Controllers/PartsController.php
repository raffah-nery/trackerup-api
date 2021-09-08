<?php
namespace App\Controllers;

use App\Models\Parts;

class PartsController
{
    public function get($params = null)
    {
        if ($params)
        {
            return Parts::select($params);
        }
        if ($_GET["category"])
        {
            return Parts::selectByCategory($_GET["category"]);
        }
        return Parts::selectAll();
    }

    public function post()
    {
        $data = json_decode(file_get_contents('php://input') , true);
        if (empty($data))
        {
            $data = $_POST;
        }
        return Parts::insert($data);
    }

    public function put($params = null)
    {
        $data = json_decode(file_get_contents('php://input') , true);
        if (empty($data))
        {
            $data = $_POST;
        }
        return Parts::update($params, $data);
    }

    public function delete($params = null)
    {
        if ($params)
        {
            return Parts::delete($params);
        }
    }
}

