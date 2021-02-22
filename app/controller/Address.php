<?php

namespace app\controller;

class Address
{
    public function index()
    {
        return 'index';
    }
    public function details($id)
    {
        return '调用当前的id' . $id;
    }
}
