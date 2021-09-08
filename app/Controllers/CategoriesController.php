<?php
namespace App\Controllers;

use App\Models\Categories;

class CategoriesController
{
    public function get($params = null)
    {
        if ($params)
        {
            return Categories::select($params);
        }
        return Categories::selectAll();
    }

    public function post()
    {
        $data = json_decode(file_get_contents('php://input') , true);
        if (empty($data))
        {
            $data = $_POST;
        }
        return Categories::insert($data);
    }

    public function put($params = null)
    {
        $data = json_decode(file_get_contents('php://input') , true);
        if (empty($data))
        {
            $data = $_POST;
        }
        return Categories::update($params, $data);
    }

    public function delete($params = null)
    {
        return Categories::delete($params);
    }
}

