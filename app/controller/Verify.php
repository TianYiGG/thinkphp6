<?php

namespace app\controller;

use app\validate\User;
use think\exception\ValidateException;

class Verify
{
    public function index()
    {
        try {
            validate(User::class)->batch(true)->check([
                'name'  => '天乙',
                'price' => 100,
                'email' => 'xiaoxin@163.com'
            ]);
        } catch (ValidateException $e) {
            dump($e->getError());
        }
    }
}
