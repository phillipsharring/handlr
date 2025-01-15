<?php

use App\Auth\LoginFormValidator;
use App\Auth\SignupFormValidator;
use App\Auth\LoginUserHandler;
use App\Auth\SignupUserHandler;
use App\Groups\CreateGroupHandler;
use App\Groups\GroupFormValidator;
use App\HomeHandler;
use Handlr\Core\Router;
use Handlr\Handlers\ViewHandler;

/** @var Router $router */
$router->get('/', [
    HomeHandler::class,
]);

$router->get('/login', [
    new ViewHandler('auth/login'),
]);

$router->post('/login', [
    LoginFormValidator::class,
    LoginUserHandler::class,
]);

$router->get('/signup', [
    new ViewHandler('auth/signup'),
]);

$router->post('/signup', [
    SignupFormValidator::class,
    SignupUserHandler::class,
]);

$router->post('/groups', [
    GroupFormValidator::class,
    CreateGroupHandler::class,
]);
