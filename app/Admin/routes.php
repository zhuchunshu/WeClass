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


// 班费 - 交费周期
Route::group([
    'prefix'     => config('admin.route.prefix')."/classfee/cycle",
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'ClassfeeCycleController@index');
    $router->get('/create', 'ClassfeeCycleController@create');
    // 导入数据
    $router->get('/import', 'ClassfeeCycleController@import');
    $router->get('/{id}/edit', 'ClassfeeCycleController@edit');
    $router->post('/import','ClassfeeCycleController@onImport');
    $router->get('/{id}', 'ClassfeeCycleController@show');
    $router->put('/{id}', 'ClassfeeCycleController@update');
    $router->delete('/{id}', 'ClassfeeCycleController@destroy');
    $router->post('/','ClassfeeCycleController@store');

});

// 班费 - 交费情况
Route::group([
    'prefix'     => config('admin.route.prefix')."/classfee/payer",
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'ClassfeePayerController@index');
    $router->get('/create', 'ClassfeePayerController@create');
    // 导入数据
    $router->get('/import', 'ClassfeePayerController@import');
    $router->get('/{id}/edit', 'ClassfeePayerController@edit');
    $router->post('/import','ClassfeePayerController@onImport');
    $router->get('/{id}', 'ClassfeePayerController@show');
    $router->put('/{id}', 'ClassfeePayerController@update');
    $router->delete('/{id}', 'ClassfeePayerController@destroy');
    $router->post('/','ClassfeePayerController@store');

});
