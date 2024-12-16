<?php

use App\Http\Route;

Route::get('/', 'TestController@get');
Route::get('/get/{id}', 'TestController@get_specific_id');


?>