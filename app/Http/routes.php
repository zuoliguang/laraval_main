<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome', ['title'=>'zuoliguang']);
});

/*------------学习模块--------------------------------------*/

Route::get('/study/route', function () {
	return 'Hello World, zuoliguang!';
});

// 控制器路、由命名路由
Route::get('/study', 'Study\IndexController@index')->name('index');
Route::get('/study/there', 'Study\IndexController@there')->name('there');
Route::get('/study/redirect', 'Study\IndexController@redirect');

// CSRF 保护
Route::get('/study/csrf', 'Study\IndexController@csrf');
Route::post('/postdata', 'Study\IndexController@postdata');

// 传递参数、参数约束、使用中间件
// 1、该位置中间件还可以添加多个，依次执行调取
// 2、中间件的生成: php artisan make:middleware CheckTest
// 3、注册位置 app/Http/Kernel.php 的 $routeMiddleware 变量设置
Route::get('/study/user/{id}', 'Study\IndexController@user')->where(['id' => '[0-9]+'])->middleware('test');
Route::get('/study/username/{name?}', 'Study\IndexController@username')->where(['name' => '[A-Za-z]+']);

// 文件上传
Route::get('/study/upload', 'Study\IndexController@upload');
Route::post('/study/doupload', 'Study\IndexController@doupload');

// 日志记录
Route::get('/study/log', 'Study\IndexController@log');

// 缓存
Route::get('/study/cache', 'Study\IndexController@cache');
Route::get('/study/session', 'Study\IndexController@session');

// 数据库操作 
Route::get('/study/user/add', 'Study\IndexController@db_add_user');
Route::get('/study/user/update', 'Study\IndexController@db_update_user');
Route::get('/study/user/get', 'Study\IndexController@db_get_user');
Route::get('/study/user/del', 'Study\IndexController@db_del_user');

// 模型 Eloquent ORM
Route::get('/study/model', 'Study\IndexController@model');


// 资源路由（将剩余未定义的方法定义）
Route::resource('study/index', 'Study\IndexController');