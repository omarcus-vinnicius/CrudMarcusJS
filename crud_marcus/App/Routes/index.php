<?php

namespace App;


use function src\setting;
use App\Controller\usersController;
use App\Middlewares\ErrorHandling\errorInsert;
use App\Middlewares\ErrorHandling\errorUpdate;


$app = new \Slim\App(setting());

$app->group('/crudphp', function () use ($app) {

    $app->get('/users', usersController::class . ':getUser');

    $app->get('/users/{id}', usersController::class . ':getUserbyID');

    $app->post('/users', usersController::class . ':postUser')
        ->add(new errorInsert());

    $app->put('/users/{id}', usersController::class . ':updateUser')
        ->add(new errorUpdate());

    $app->delete('/users/{id}', usersController::class . ':deleteUser');
});





$app->run();

