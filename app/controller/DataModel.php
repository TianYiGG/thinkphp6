<?php

namespace app\controller;

use app\model\User as UserModel;

class DataModel
{
    public function index()
    {
        return json(UserModel::select());
    }
    public function insert()
    {
        $user = new UserModel();
        //单个新增
        // $user->save([
        //     'keywords' => '宇智波鼬',
        //     'link' => 'yidaqisang.com',
        //     'img' => 'yidaqi,jpg',
        //     'position' => '2',
        //     'industry' => '1',
        //     'time' => '2021-2-19',
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
        $res = $user->where('keywords', '卡卡西')->find();
        $res->keywords = '飞雷神之术';
        $res->link = 'yuzhiboquan.com';
        //限制只修改keywords
        $res->allowField(['keywords'])->save();
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
}
