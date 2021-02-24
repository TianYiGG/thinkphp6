<?php

namespace app\index\controller;

use app\BaseController;
use app\index\model\User;
use think\facade\Db;

class DataTest extends BaseController
{
    public function initialize()
    {
        Db::event('before_select', function ($query) {
            echo '执行了批量查询';
        });
        Db::event('before_find', function ($query) {
            echo '查询了一条数据';
        });
        Db::event('after_update', function ($query) {
            echo '执行了修改操作';
        });
    }
    public function index()
    {
        // $requrst =  Db::table('tp_user')->select();
        // return json($requrst);
        // $requrst = Db::table('tp_user')->where('id', 3)->find();
        // return json($requrst);
        // $requrst = Db::table('tp_user')->where('id', 300)->findOrFail();
        // $requrst = Db::table('tp_user')->where('id', 4)->findOrEmpty();
        // return Db::getlastsql();
        //$requrst =  Db::table('tp_user')->select()->toArray();
        //return json($requrst);
        //$requrst =  Db::name('user')->select()->toArray();
        //dump($requrst);
        // $requrst = Db::name('user')->where('id', 13)->value('link');
        // $requrst = Db::name('user')->column('keywords', 'id');
        // return json($requrst);
        //使用chunk 查询数据集时 可以节约内存开销
        // Db::name('user')->chunk(5, function ($data) {
        //     foreach ($data as $datas) {
        //         dump($datas);
        //     }
        //     echo 1;
        // });
        //游标查询 更大数据的查询方法  更节约内存开销
        // $res = Db::name('user')->cursor();
        // foreach ($res as $data) {
        //     dump($data);
        // }
        $data = Db::name('user');
        $res = $data->order('id', 'asc')->select()->toArray();
        return json($res);
    }
    public function insert()
    {
        $data = [
            'username' => '辉夜',
            'password' => '123',
            'gender' => '女',
            'email' => 'huiye@163.com',
            'price' => 90,
            'details' => '123',
            'uid' => 1011,
            'status' => 1,
            'list' => ['username' => '辉夜', 'gender' => '女', 'email' => 'huiye@163.com'],
        ];
        //return Db::name('user')->insert($data);
        return Db::name('user')->json(['list'])->insert($data);
    }
    public function update()
    {
        // $data = [
        //     'keywords' => '宇智波佐助'
        // ];
        // return Db::name('user')->where('id', 18)->update($data);
        // $data = [
        //     'id' => 17,
        //     'keywords' => '宇智波佐助'
        // ];
        // return Db::name('user')->update($data);
        //return Db::name('user')->where('id', 19)->save(['keywords' => '宇智波鼬']);
        // $data['img'] = ['username' => '李白', 'gender' => '男', 'email' => 'libai@163.com'];
        // Db::name('user')->json(['img'])->where('id', 43)->update($data);
        $data['list->username'] = '一乐';
        return Db::name('user')->json(['list'])->where('id', 306)->update($data);
    }
    public function delete()
    {
        // return Db::name('user')->delete(19);
        return Db::name('user')->delete([14, 15]);
        // return Db::name('user')->where('id', 18)->delete();
    }
    public function query()
    {
        //$res = Db::name('user')->where('keywords', 'like', '%公%')->select(); //模糊查询
        //$res = Db::name('user')->where('keywords', 'like', ['%漩%', '%宇%'], 'or')->select(); //模糊查询
        $res = Db::name('user')->where('status', 1)->select();
        //$res = Db::name('user')->json(['list'])->where('list->username', '大筒木辉夜')->find();
        //return Db::getLastsql();
        return json($res);
    }
    public function limit()
    {
        $res = Db::name('user')->limit(5, 3)->order('id', 'asc')->select();
        return json($res);
    }
    public function linkup()
    {
        //$result = Db::name('user')->field('keywords')->select();
        // $result = Db::name('user')->fieldRaw('id, SUM(id)')->select();
        //$result = Db::name('user')->orderRaw('FIELD(id,16) DESC')->select();
        $result = Db::name('user')->group('state')->select();
        return $result;
    }
    public function senior()
    {
        // $res = Db::name('user')->where('keywords|link', 'like', '%宇%')->select();
        // $res = Db::name('user')->where('keywords|link', 'like', '%宇%')->select();
        // $map1 = [
        //     ['keywords', 'like', '宇'],
        //     ['link', 'like', 'https']
        // ];
        // $map2 = [
        //     ['keywords', 'like', '宇'],
        //     ['link', 'like', 'https']
        // ];
        // $res  = Db::name('user')->whereOr([$map1, $map2])->select();

        $res = Db::name('user')->where(function ($query) {
            $query->where('id', '>', 10);
        })->where(function ($query) {
            $query->whereOr('keywords', 'like', '%宇%');
        })->select();

        //return Db::getLastSql();
        return $res;
    }
    public function affair()
    {
        //数据库的事务操作  出错之后 不会在执行数据变动
        // Db::transaction(function () {
        //     Db::name('user')->where('id', 16)->save(['state' => Db::raw('state - 3')]);
        //     Db::name('user1')->where('id', 17)->save(['state' => Db::raw('state + 3')]);
        // });
        // try {
        //     Db::name('user')->where('id', 16)->save(['state' => Db::raw('state - 3')]);
        //     Db::name('user1')->where('id', 17)->save(['state' => Db::raw('state + 3')]);
        //     //提交事务 Db::commit();
        // } catch (\Exception $e) {
        //     echo '执行 SQL 失败！';
        //     //回滚 
        //     Db::rollback();
        // }
        $res = Db::name('user')->withAttr('link', function ($value, $data) {
            return strtoupper($value);
        })->select();
        return json($res);
    }

    public function collection()
    {
        $res = Db::name('user')->select();
        dump($res->toArray());
    }

    //切换数据库链接
    public function dome()
    {
        $requrst =  Db::connect('page')->table('tp_dome')->select();
        return json($requrst);
    }
    public function getUser()
    {
        $user = User::select();
        return json($user);
    }
}
