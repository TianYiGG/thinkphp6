<?php

namespace app\controller;

use app\model\User;
use think\facade\Db;

class DataTest
{
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
            'keywords' => '漩涡鸣人',
            'link' => 'https://www.baidu.com/s?tn=02003390_hao_pg&ie=utf-8&wd=%E6%BC%A9%E6%B6%A1%E9%B8%A3%E4%BA%BA',
            'img' => 'https://image.baidu.com/search/detail?ct=503316480&z=0&ipn=d&word=%E6%BC%A9%E6%B6%A1%E9%B8%A3%E4%BA%BA&step_word=&hs=0&pn=3&spn=0&di=103070&pi=0&rn=1&tn=baiduimagedetail&is=0%2C0&istype=0&ie=utf-8&oe=utf-8&in=&cl=2&lm=-1&st=undefined&cs=129112372%2C1288772961&os=4292307746%2C3314956532&simid=3479918948%2C341205045&adpicid=0&lpn=0&ln=1685&fr=&fmq=1613637071931_R&fm=&ic=undefined&s=undefined&hd=undefined&latest=undefined&copyright=undefined&se=&sme=&tab=0&width=undefined&height=undefined&face=undefined&ist=&jit=&cg=&bdtype=0&oriquery=&objurl=https%3A%2F%2Fgimg2.baidu.com%2Fimage_search%2Fsrc%3Dhttp%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201805%2F22%2F20180522212246_kshuv.thumb.700_0.jpg%26refer%3Dhttp%3A%2F%2Fb-ssl.duitang.com%26app%3D2002%26size%3Df9999%2C10000%26q%3Da80%26n%3D0%26g%3D0n%26fmt%3Djpeg%3Fsec%3D1616229074%26t%3Dbfadb6863820e2c21a308d32263c2a54&fromurl=ippr_z2C%24qAzdH3FAzdH3Fooo_z%26e3B17tpwg2_z%26e3Bv54AzdH3Fks52AzdH3F%3Ft1%3Dldlbdlmda&gsm=1&rpstart=0&rpnum=0&islist=&querylist=&force=undefined',
            'position' => 1,
            'industry' => 1,
            'time' => 1612022400,
            'state' => 2
        ];
        //return Db::name('user')->insert($data);
        return Db::name('user')->save($data);
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
        return Db::name('user')->where('id', 19)->save(['keywords' => '宇智波鼬']);
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
        $res = Db::name('user')->where('keywords', 'like', ['%漩%', '%宇%'], 'or')->select(); //模糊查询
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
