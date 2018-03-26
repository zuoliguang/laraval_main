<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pwd extends Model
{
    /**
     * 与模型关联的数据表
     * @var string
     */
    protected $table = 'm_pwd';

    /**
     * 模型的主键
     * @var string
     */
    public $primaryKey = 'id';
}
