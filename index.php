<?php

    require_once __DIR__."/vendor/autoload.php";
    require_once __DIR__ ."/src/Routes/main.php";


    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    use App\Core\Core;
    use App\Http\Route;

    $rotas = Route::routes();

    $Initializer = new Core; 
    $Initializer->dispatch($rotas);

?>
