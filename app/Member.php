<?php

namespace App;

use App\Pwd;
use App\Say;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * 与模型关联的数据表
     * @var string
     */
    protected $table = 'member';

    /**
     * 模型的主键
     * @var string
     */
    public $primaryKey = 'id';

    /**
     * 该模型是否被自动维护时间戳
     * @var bool
     */
    public $timestamps = false;

    /**
     * 添加可以批量赋值的字段
     * @var array
     */
    protected $fillable = ['name', 'age', 'tel', 'address', 'score', 'class', 'ext_info'];

    /**
	 * 不可被批量赋值的属性
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * 关联 pwd 表 一对一
	 */
	public function pwd()
	{
		return $this->hasOne('App\Pwd', 'm_id', 'id'); // 关联的模型，关联模型对应的字段，当前模型的字段
	}
	
	/**
	 * 关联 say 表 一对多
	 */
	public function say()
	{
		return $this->hasMany('App\Say', 'm_id', 'id');
	}

}
