<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'name'  => [
            'require',
            'max' => 10,
            'chs',
        ],
        'price' => [
            'number',
            'between' => '1,100'
        ],
        'email' => 'email'
    ];
    /*
    *场景验证
    比如 在新增时 需要验证用户名  密码 和邮箱
    那么在修改时  只需要验证 用户名和 邮箱就可以了
    */
    protected $scene = [
        'insert' => ['name', 'price', 'email'],
        'edit' => ['name', 'price'],
    ];

    protected function sceneEdit()
    {
        $edit =  $this->only(['name', 'price']) //仅对两个字段进行验证
            ->remove('name', 'max') //移除对name属性的  最大值限制
            ->append('price', 'require'); //给price添加一个不能为空的显示
        return $edit;
    }
    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'name.require' => '姓名不得为空',
        'name.max' => '姓名不得大于 20 位',
        'price.number' => '价格必须是数字',
        'price.between' => '价格必须 1-100 之间',
        'email' => '邮箱的格式错误'
    ];

    //自定义规则
    // protected $rules = [
    //     'name' => 'require|max:20|checkName:天乙',
    // ];
    // protected function checkName($value, $rules)
    // {
    //     return $value == $rules ? '名称存在非法称谓' : '';
    // }
}
