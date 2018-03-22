<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('users', UserController::class);

    $router->resource('topics', TopicController::class);

    $router->resource('questions', QuestionController::class);

    $router->get('api/users/pie','ChartDataController@sex');
    $router->get('api/users/line','ChartDataController@userUp');
});
