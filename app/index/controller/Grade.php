<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use app\index\model\Profile as ProfileModel;
use app\index\model\Role;

class Grade
{
    //一对一关联
    public function index()
    {
        //输出正向关联的数据
        // $user = UserModel::find(19);
        // return $user->profile->hobby;
        //输出反向关联的数据
        // $profile = ProfileModel::find(1);
        // return $profile->user->username;
        //修改关联表的数据
        // $user = UserModel::find(19);
        // $user->profile->save(['hobby' => '酷爱小姐姐']);
        //新增关联表的数据
        // $user = UserModel::find(19);
        // $user->profile()->save(['hobby' => '酷爱小姐姐']);

    }
    //一对多
    public function many()
    {
        $user = UserModel::find(19);
        // return $user->profile;
        // $user = UserModel::find(19);
        // return $user->profile()->where('id', '>', 10)->select();
        //使用 has()方法，查询关联附表的主表内容，比如大于等于 2 条的主表记录；
        //return  UserModel::has('profile', '>=', 2)->select();
        //一对多关联新增和批量新增
        //$user->profile()->save(['hobby' => '想去旅游']);
        // $user->profile()->saveAll([
        //     ['hobby' => '想和小姐姐去旅游'],
        //     ['hobby' => '想和大姐姐去旅游'],
        // ]);
        //一对多关联删除
        $user = UserModel::with('profile')->find(308);
        $user->together(['profile'])->delete();
    }
    //多对多关联查询
    public function manys()
    {
        $user = UserModel::find(19);
        // 输出这个角色所具有的权限
        //return $user->roles;
        // $user->roles()->save(['type' => '特殊管理员']);
        //新增一条权限
        // $user->roles()->save(1);
        //或者用另外一种方式新增
        // $user->roles()->save(Role::find(1));
        //或者 
        // $user->roles()->attach(1);
        //删除中间表数据
        $user->roles()->detach(1);
    }
    //关联预载入
    public function load()
    {
        // $list = UserModel::select([19, 20, 21]);
        // foreach ($list as $user) {
        //     dump($user->profile);
        // }
        $list = UserModel::with(['profile'])->select();
        foreach ($list as $user) {
            dump($user->profile->toArray());
        }
    }
    //关联统计和输出
    public function count()
    {
        // $list = UserModel::withCount(['profile'])->select([19, 20, 21]);
        // foreach ($list as $user) {
        //     echo $user->profile_count;
        // }
        $list = UserModel::withSum(['profile'], 'status')->select([19, 20, 21]);
        foreach ($list as $user) {
            echo $user->profile_sum . '<br>';
        }
    }
}
