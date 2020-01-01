<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

# /api/v1/
$router->get('/', function () use ($router) {
    return $router->app->version();
});

# /api/v1/linebot_api/accounting
$router->group(['namespace' => 'LineBot'], function () use ($router) {
    # accounting
    $router->get('/linebot_api/accounting', 'LinebotController@test');
    $router->post('/linebot_api/accounting', 'LinebotController@accountingAction');
});
