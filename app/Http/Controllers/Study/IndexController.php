<?php

namespace App\Http\Controllers\Study;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
	function __construct()
	{
		$route = Route::current();
		$name = Route::currentRouteName();
		$action = Route::currentRouteAction();

		// echo '<pre>';
		// print_r($route);die();
		// var_dump($name);
		// var_dump($action);
	}

/*---------路由访问------------------------------------------*/

	public function index()
	{
		echo "Study\IndexController:index";
	}

	public function there()
	{
		echo "Study\IndexController:there";
	}

	public function redirect()
	{
		// return redirect()->route('there'); // 跳转到对应的路由
		return redirect()->action('Study\IndexController@username', ['name'=>'testName']); // 跳转至某个控制器的某个方法
	}

	public function show()
	{
		echo '资源路由 注册之外的路由!!!!!!';
	}

/*------- CSRF 保护 , 参数获取---------------------------------------------*/

	public function csrf()
	{
		$data = ['test'=>'zuoliguang'];
		return view('form', $data);
	}

	public function postdata(Request $request)
	{
		$uri = $request->path(); // 获取实际路径
		$url = $request->url(); // 获取地址
		$fullUrl = $request->fullUrl(); // 获取地址
		$is_post = $request->isMethod('post'); // 是否是post
		$is_get = $request->isMethod('get'); // 是否是get
		$_token = $request->_token;
		$test = $request->test;
		$all = $request->all(); // 获取传入的所有参数
		$isHas = $request->has(['name', 'email']); // 是否有 name、email 字段信息
		// $filled = $request->filled('name'); // 是否存在值并且不为空 (laravel 5.5有)

		var_dump($uri);echo "<pre>";
		var_dump($url);echo "<pre>";
		var_dump($fullUrl);echo "<pre>";
		var_dump($is_post);echo "<pre>";
		var_dump($is_get);echo "<pre>";
		var_dump($_token);echo "<pre>";
		var_dump($test);echo "<pre>";
		var_dump($all);echo "<pre>";
		var_dump($isHas);echo "<pre>";
		// var_dump($filled);echo "<pre>";
	}

	public function user($id)
	{
		var_dump($id);
	}

	public function username($name='zlgcg')
	{
		var_dump($name);
	}


/*--------文件上传、session -------------------------------------*/

public function upload()
{
	return view('upload');
}

// 文件上传, 将获得的有效文件使用插件保存到指定地址即可 
public function doupload(Request $request)
{
	$file = $request->file('file');
	$file_path = ''; // 上传后的文件地址 
	// 验证文件是否有效
	if ($file->isValid()) {
		$path = $file->path(); // 临时文件的存放地址
		$name = $file->getClientOriginalName(); // 图片名称
		$ext = $file->getClientOriginalExtension(); // 图片格式
		$size = $file->getClientSize(); // 图片大小
		$file_content = file_get_contents($path);
		$file_name = date('Y-m-d-H-i-s-').$name;
		Storage::disk('local')->put($file_name, $file_content);
		$file_path = config()->get('filesystems.disks.local.root')."/".$file_name;
	}
	
	if (!empty($file_path)) {
		echo '文件上传成功，地址：'.$file_path;
	} else {
		echo '文件上传失败';
	}
}

// 框架的存储器
public function cache()
{
	// 存储
	Cache::add('kkk', 'zuoliguang', 300);
	$v = Cache::get('kkk');

	// 永久存储
	Cache::forever('fff', 'zlgcg');
	$v = Cache::get('fff');

	// 删除
	Cache::forget('kkk'); // 删除指定的信息
	Cache::flush(); // 删除所有

	// var_dump($v);
}

public function session(Request $request)
{
// --------------------------全局函数 sesseion();
// --------------------------HTTP 请求实例 $request->session()
// 1、session 
	// 存储
	session(['kkk' => 'zuoliguanghhhh']);
	// 获取
	$v = session('kkk');
	// 指定默认值
	$v = session('qqq', 'default');

	// var_dump($v);

// 2、$request->session() 存储
	// 存储
	$request->session()->put('aaa', 'zuoliguangaaaa');
	$request->session()->put('bbb', 'zuoliguangbbbb');
	// 添加新值
	$request->session()->push('user.teams', 'developers');

	// 删除
	$v = $request->session()->pull('bbb', 'default_bbb');

	// var_dump($v);

	// 获取
	$v = $request->session()->get('aaa'); // 获取指定信息
	$vs = $request->session()->all(); // 获取所有信息
	
    // 删除
    $request->session()->forget('key');
    // 全部删除
    $request->session()->flush();

	var_dump($vs);

}

/*-----日志--------------------------------------------------------*/

	public function log()
	{
		// 日志文件默认记录的地址 APP_PATH/storage/logs/laravel.log
		// 日志的信息格式可以自己定义
		// 实际开发中会将该文件保存到根路径下或者项目之外
		$message = 'this is an log infomation for laravel study!!!!!!';
		Log::emergency($message.'-emergency '.PHP_EOL);
		Log::alert($message.'-alert '.PHP_EOL);
		Log::critical($message.'-critical '.PHP_EOL);
		Log::error($message.'-error '.PHP_EOL);
		Log::warning($message.'-warning '.PHP_EOL);
		Log::notice($message.'-notice '.PHP_EOL);
		Log::info($message.'-info '.PHP_EOL);
		Log::debug($message.'-debug '.PHP_EOL);
		return response('日志结束');
	}


/*-------------------------------------------------------------*/




/*-------------------------------------------------------------*/




/*-------------------------------------------------------------*/




/*-------------------------------------------------------------*/




/*-------------------------------------------------------------*/




}