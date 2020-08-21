<?php


$router->get('/', 'HomePageController@index');
$router->get('/test', 'HomePageController@test');
$router->get('/migrate', 'Database\MigrationsController@index');


$router->get('/tasks/create', 'TasksController@create');
$router->get('/tasks/{:id}/edit', 'TasksController@edit');
$router->put('/tasks/{:id}', 'TasksController@update');
$router->post('/tasks', 'TasksController@store');

$router->get('/login', 'AuthController@index');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');





