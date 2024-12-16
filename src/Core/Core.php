<?php

namespace App\Core;

class Core {
    public function dispatch(array $routes) {

        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        $prefixController = 'App\\Controllers\\';

        $path = parse_url($url, PHP_URL_PATH);
        $localhost = false;


        // Remover o prefixo do site (e.g., '/site-vendas/api/')
        //$path = str_replace('/site-vendas/api/', '', $path);


        $validacao_localhost = explode('/', $path);

        if ($validacao_localhost[1] === $_ENV['PROJECT_NAME'] ) {
           $localhost = true;
           $path = preg_replace('/^\/php-api-skeleton/', '', $path);
        }


        $parts = explode('/', $path);

        if (count($parts) < 2) {
            http_response_code(400);
            echo json_encode([
                "status" => false,
                "error" => "URL inválida. Deve conter pelo menos um controlador e um método."
            ]);
            return;
        }
        

        $controller = ucfirst($parts[1]) . 'Controller';
        $method = $parts[2]; 
        $params = array_slice($parts, 3); 

        $controllerClass = $prefixController . $controller;


        $controllerFound = false;

        foreach ($routes as $route) {


            
            $route['path'] = "/".$parts[1].$route['path'];
            
            
            [$controllerRoute, $action] = explode('@', $route['action']);

            if(
                $route['path'] == $path &&
                $controllerRoute == $controller &&
                $_SERVER['REQUEST_METHOD'] == $route['method']
            ) {
                $controllerFound = true;
                break;
            }

            //     $controller = $prefixController . $controller;
            //     $extendController = new $controller();
            //     $extendController->$action($matches);
            // }
        }


        if (!$controllerFound) {
            http_response_code(404);
            echo json_encode([
                "status" => false,
                "error" => "URL inválida. Método não encontrado."
            ]);
            return;
        }


        $extendController = new $controllerClass();

        //print_r($action);die;
        if(method_exists($extendController, $action)) {
            $retorno = $extendController->$action($params);
            print_r($retorno);
            return;
        }


        http_response_code(404);
        echo json_encode([
            "status" => false,
            "error" => "URL inválida. Método não encontrado."
        ]);
        return;
        
    }
}


?>