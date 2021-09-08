<?php
header('Content-Type: application/json');
require_once '../vendor/autoload.php';

if ($_GET['url'])
{
    $url = explode('/', $_GET['url']);

    if ($url[0] === 'v1')
    {
        array_shift($url);
        $controller = 'App\Controllers\\' . ucfirst($url[0]) . 'Controller';
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        array_shift($url);
        try
        {
            $response = call_user_func_array(array(
                new $controller,
                $method
            ) , $url);

            http_response_code(200);
            echo json_encode(array(
                'status' => 'success',
                'data' => $response
            ));
            exit;
        }
        catch(\Exception $e)
        {
            http_response_code(404);
            echo json_encode(array(
                'status' => 'error',
                'data' => $e->getMessage()
            ) , JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
}

