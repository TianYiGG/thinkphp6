<?php

namespace app\controller;

use app\BaseController;
use app\model\User as UserModel;

class DataModel
{

    public function index()
    {
        // $res = UserModel::select()
        // return json($res);
    }
    public function insert()
    {
        $user = new UserModel();
        $user->create([
            'username' => '小樱',
            'password' => '123',
            'gender' => '女',
            'email' => 'sakulajiang@163.com',
            'pirce' => 90,
            'details' => '123',
            'uid' => 1001,
            'list' => ['username' => '辉夜', 'gender' => '女 ', 'email' => 'huiye@163.com'],
        ]);

        //单个新增
        // $user->save([
        //     'keywords' => '宇智波富岳',
        //     'link' => 'fuyue.com',
        //     'img' => 'fuyue.jpg',
        //     'position' => '2',
        //     'industry' => '1',
        //     'state' => '2'
        // ]);
        //批量新增
        // $dataAll = [
        //     [
        //         'keywords' => '鼬',
        //         'link' => 'yidaqisang.com',
        //         'img' => 'yidaqi.jpg',
        //         'position' => '2',
        //         'industry' => '1',
        //         'time' => '2021-2-30',
        //         'state' => '2'
        //     ],
        //     [
        //         'keywords' => '卡卡西',
        //         'link' => 'kakaxi.com',
        //         'img' => 'kakaxi.jpg',
        //         'position' => '2',
        //         'industry' => '1',
        //         'time' => '2021-2-20',
        //         'state' => '2'
        //     ],
        // ];
        // dump($user->saveAll($dataAll));
    }
    public function query()
    {
        $user = UserModel::select();
        return json($user);
        // $user = UserModel::where('list->username', '一乐')->find();
        // return $user->list->email;
    }
    public function delete()
    {
        $user = new UserModel();
        // $res = $user->find(30);
        // dump($res->delete());
        // dump($user->destroy([4, 6]));
        //dump($user->where('id', '>', 25)->delete());
        $user->destroy(function ($query) {
            $query->where('id', '<', 10);
        });
    }
    public function update()
    {
        $user = new UserModel();
        $res = $user->find(306);
        $res->list->username = '大筒木辉夜';
        $res->save();
        //使用 find()方法获取数据，然后通过 save()方法保存修改，返回布尔值
        // $res = $user->find(25);
        // $res->keywords = '宇智波带土';
        // $res->link = 'daitusang.com';
        // $res->save();
        //通过 where()方法结合 find()方法的查询条件获取的数据，进行修改
        // $res = $user->where('keywords', '卡卡西')->find();
        // $res->keywords = '止水';
        // $res->link = 'zhishui.com';
        // dump($res->save());
        // $res = $user->where('keywords', '宇智波带土')->find();
        // $res->keywords = '飞雷神之术';
        // $res->link = 'feileishen.com';
        //限制只修改keywords
        // $res->allowField(['keywords'])->save();
        //动态限制不可修改字段;
        //$res->readonly(['link'])->save();
    }
    public function field()
    {
        $user = new UserModel();
        return $user->getKeywords();
    }
    public function getattr()
    {
        $user = UserModel::find(13);
        return $user->state;
    }
    //模型的查询范围
    public function scope()
    {
        // $res = UserModel::scope('male')->select();
        // return json($res);
        // $res = UserModel::scope('link', 'kakaxi')->select();
        // $res = UserModel::link('kakaxi.com')->select();
        $res = UserModel::scope('keywords', '金色闪光')
            ->scope('male')
            ->select();
        return json($res);
    }
}
