<?php

namespace App\Service;

class TestService {
    public function hello() {
        return [
            'StatusCode' => 200,
            'msg' => 'Hello World!'
        ];
    }
}

?>