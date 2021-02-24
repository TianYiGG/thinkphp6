<?php

namespace app\index\model;

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
    //自定义创建时间字段名称;
    protected $createTime = 'time';
    //设置createTime字段类型 为  datatime类型;
    protected $autoWriteTimestamp = 'datetime';
    protected $json = ['list'];
    protected static function init()
    {
        //第一次实例化的时候执行 init 
        parent::init();
        //echo '初始化 User 模型';
    }
    //一对一关联查询
    // public function profile()
    // {
    //     return $this->hasOne(Profile::class, 'user_id');
    // }
    //一对多关联查询
    public function profile()
    {
        return $this->hasMany(Profile::class, 'user_id');
    }
    public function book()
    {
        return $this->hasMany(Book::class, 'user_id');
    }
    //多对多关联查询
    public function roles()
    {
        return $this->belongsToMany(Role::class, Access::class, 'role_id', 'user_id');
    }
    //模型的操作生命周期函数
    // protected static function onAfterRead()
    // {
    //     echo '执行了查询方法';
    // }
    public function getKeywords()
    {
        $res = $this->find(20);
        return $res->keywords;
    }
    //获取器
    public function getStateAttr($value)
    {
        $arr = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        return $arr[$value];
    }
    //模型的查询范围
    public function scopeMale($query)
    {
        $query->where('link', 'kakaxi.com')->field('id,keywords,link')->limit(5)->order('id', 'desc');
    }
    public function scopeLink($query, $value)
    {
        $query->where('link', 'like', '%' . $value . '%');
    }
}
