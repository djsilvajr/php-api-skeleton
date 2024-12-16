<?php

namespace App\Controllers;
use App\Service\TestService;


class TestController {

    private $var;

    public function get(){

        $service = new TestService();
        $response = $service->hello();
        http_response_code($response['statusCode']);
        return $response;

    }
}

//$test = new TestController('Hello World!');


?>