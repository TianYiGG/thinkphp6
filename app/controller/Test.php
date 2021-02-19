<?php

namespace app\controller;

use app\BaseController;

class Test extends BaseController
{
    public function index()
    {
        return 'hello 当前方法' . $this->request->action();
    }
    public function hello($value = "")
    {
        return 'hello 当前目录是' . $this->app->getBasePath();
    }
    public function arr()
    {
        $requrst = ['id' => 1, 'username' => '小明', 'age' => 20];
        return json($requrst);
    }
}
