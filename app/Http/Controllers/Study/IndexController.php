<?php

namespace App\Http\Controllers\Study;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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


/*---------数据库操作----------------------------------------------------*/

	// 这里使用 member 的数据表
	// 新增
	public function db_add_user()
	{
		// 1、单处理
		$member = ['name'=>'zlhppppp', 'age'=>45, 'tel'=>'9999999999', 'address'=>'testkkkkkkkk', 'score'=>90, 'class'=>'3-5', 'ext_info'=>'hahahahaha'];
		// DB::table('member')->insert($member); // 插入数据不返回id
		// $id = DB::table('member')->insertGetId($member); // 插入数据返回id
		// var_dump($id);

		// 2、批处理
		$members = [
			['name'=>'zlhxxxxx', 'age'=>45, 'tel'=>'9999999999', 'address'=>'testkkkkkkkk', 'score'=>90, 'class'=>'3-5', 'ext_info'=>'hahahahaha'],
			['name'=>'zlhzzzzz', 'age'=>45, 'tel'=>'9999999999', 'address'=>'testkkkkkkkk', 'score'=>90, 'class'=>'3-5', 'ext_info'=>'hahahahaha']
		];
		// DB::table('member')->insert($members);
		// echo "批量插入数据";

		// 3、sql操作 
		// DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle']);
	}

	// 更新
	public function db_update_user()
	{
		// 1、依据id更新
		$data = ['name'=>'zuoliguang'];
		DB::table('member')->where('id', 4)->update($data);

		// 2、自增减
		// DB::table('member')->where('id', 4)->increment('score'); // 自增
		// DB::table('member')->where('id', 4)->decrement('score'); // 自减
		
		// 3、sql 操作
		// $affected_rows = DB::update('update users set votes = 100 where name = ?', ['John']);
		
		// 4、数据库事务
			// -----a、架构封装的 ( 第二参数定义在发生死锁时应该重新尝试事务的次数 )
			// DB::transaction(function () {
				// DB::table('users')->update(['votes' => 1]);
				// DB::table('posts')->delete();
			// }, 5);
			// -----b、手动
			// DB::beginTransaction(); // 开启事务
			// DB::rollBack(); // 回滚事务
			// DB::commit(); // 提交事务
		
	}

	// 查询
	public function db_get_user()
	{
		// 1、条件查询
		$data = DB::select('select * from member where id = ?', [1]); // 使用sql查询
		$data = DB::table('member')->get(); // 获取
		$data = DB::table('member')->offset(2)->limit(5)->get(); // 分页获取
		$data = DB::table('member')->inRandomOrder->get(); // 获取并混排
		$data = DB::table('member')->where('name', 'aaa')->get(); // 条件搜索
		$data = DB::table('member')->where('name', 'aaa')->first(); // 条件搜索的第一条
		$data = DB::table('member')->where('id', '>', '0')->value('id'); // 条件搜索的第一条的id字段
		$data = DB::table('member')->pluck('name', 'id'); // 获取表 name 信息 并以 id为键，name为值
		$data = DB::table('member')->select('id', 'name')->addSelect('age')->get(); // 字段

		$data = DB::table('member')->where('name', 'like', '%a%')->get(); // 模糊条件搜索
		$data = DB::table('member')->where('score', '>=', 70)->get(); // 判断条件搜索

		$data = DB::table('member')->whereBetween('score', [70, 90])->get(); // 范围条件搜索
		$data = DB::table('member')->whereNotBetween('score', [70, 90])->get(); // 范围条件搜索

		$data = DB::table('member')->whereIn('class', ['3-1', '3-2'])->get(); // 枚举条件搜索
		$data = DB::table('member')->whereNotIn('class', ['3-1', '3-2'])->get(); // 枚举条件搜索

		$data = DB::table('member')->where([ ['score', '>=', 70], ['class', '=', '3-2'] ])->get(); // 组合条件搜索
		// var_dump($data);die();

		// 2、结果分块
		DB::table('member')->orderBy('id', 'desc')->chunk(2, function($members){
			foreach ($members as $member) {
				// 该方式用来阻止循环
				if ($member->id <= 1 ) {
					return false;
				}
				// var_dump($member);
			}
		});

		// 3、聚合函数
		$data = DB::table('member')->count(); // 数量
		$data = DB::table('member')->max('age'); // 最大值
		$data = DB::table('member')->avg('age'); // 平均值
		$data = DB::table('member')->distinct()->pluck('age'); // 去重

		// 4、链式查询
		$data = DB::table('member')
				->select('class', DB::raw(' SUM(score) as total_score '))
				->groupBy('class')
				->havingRaw(' SUM(score) > 60 ')
				->get();
		// var_dump($data);
		
		// 5、连表查询
		$data = DB::table('member')
				// ->join('m_pwd', 'member.id', '=', 'm_pwd.m_id')
				->leftJoin('m_pwd', 'member.id', '=', 'm_pwd.m_id')
				->select('member.name', 'm_pwd.pwd')->get();
		// var_dump($data);

		// 6、Where Exists 语句
		$data = DB::table('member')
			->whereExists(function($query){
				$query->select(DB::raw(1))
					->from('m_pwd')
					->whereRaw('m_pwd.m_id=member.id');
			})->get();
			// sql : select * from member where exists ( select 1 from m_pwd where m_pwd.m_id = member.id )
			// 即找到 m_pwd 中有对应的 member 数据
		var_dump($data);
		
	}

	// 删除 
	public function db_del_user()
	{
		DB::table('member')->where('id', 4)->delete();
		// $deleted_rows = DB::delete('delete from users'); // sql 操作
	}


/*---------模型类--------------------------------------------*/

	// 1、laravel 和 Yii 框架在这方面使用的是一样的；
	// 2、ActiveRecord 创建模型类 实现 数据间的交互关联；
	// 3、对于开发有要求的企业进行操作处理;
	// 4、此处暂不做深入讲解，上面讲解的数据库操作细节可全部移至模型中展开代码操作；
	// 5、致此 初入 laravel 框架完成 简单初级的 MVC 框架开发；
	// 6、后续还会对该框架进行深入的开发研究

}