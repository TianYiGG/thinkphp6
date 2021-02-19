<?php

namespace app\model;

use think\Model;

class User extends Model
{
    //protected $connection = 'mysql';
    //设置表名
    //protected $table = 'tp_book';
    //修改主键
    //protected $pk = 'state';
    //开启非严格字段
    protected $strict = false;
    protected static function init()
    {
        //第一次实例化的时候执行 init 
        parent::init();
        //echo '初始化 User 模型';
    }
    public function getKeywords()
    {
        $res = $this->find(20);
        return $res->keywords;
    }
    public function getStateAttr($value)
    {
        $arr = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        return $arr[$value];
    }
}
