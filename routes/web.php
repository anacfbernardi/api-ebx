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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/reset', [
    'as' => 'profile', 'uses' => 'Reset\ResetController@reset'
]);

$router->get('/balance', [
    'as' => 'profile', 'uses' => 'Balance\BalanceController@show'
]);

$router->post('/event', [
    'as' => 'profile', 'uses' => 'Event\EventController@create'
]);
