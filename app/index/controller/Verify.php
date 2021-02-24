<?php

namespace app\index\controller;

use app\validate\User;
use think\facade\Validate;
use think\exception\ValidateException;

class Verify
{
    public function index()
    {
        try {
            validate(User::class)->batch(true)->scene('edit')->check([
                'name'  => '啦啦啦1',
                'price' => 100,
                'email' => 'xiaoxin163.com'
            ]);
        } catch (ValidateException $e) {
            dump($e->getError());
        }
    }
    public function route($id)
    {
        return 'id=' . $id;
    }
    public function single()
    {
        dump(Validate::isEmail('123@qq.com'));
    }
}
