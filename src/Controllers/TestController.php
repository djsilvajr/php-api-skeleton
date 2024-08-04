<?php

namespace App\Controllers;


class TestController {

    private $var;

    public function setVar(string $var) {
        $this->var = $var;
    }

    public function getVar() {
        return $this->var;
    }

    public function index(){
        $this->setVar('Hello World!');
        return $this->getVar();
    }
}

//$test = new TestController('Hello World!');


?>