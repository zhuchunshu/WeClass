<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // 上传
    $router->post('/upload', 'UploadContoller@handle');

});


// 同学管理
Route::group([
    'prefix'     => config('admin.route.prefix')."/classmates",
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'ClassmateController@index');
    $router->get('/create', 'ClassmateController@create');
    // 导入数据
    $router->get('/import', 'ClassmateController@import');
    $router->get('/{id}/edit', 'ClassmateController@edit');
    $router->post('/import','ClassmateController@onImport');
    $router->get('/{id}', 'ClassmateController@show');
    $router->put('/{id}', 'ClassmateController@update');
    $router->delete('/{id}', 'ClassmateController@destroy');
    $router->post('/','ClassmateController@store');

});
